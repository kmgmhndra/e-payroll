# ================================================
# STAGE 1: Build Assets (Node.js)
# ================================================
FROM node:20-alpine AS node-builder

WORKDIR /app

# Copy package files first (cache layer)
COPY package.json package-lock.json ./
RUN npm ci

# Copy source & build
COPY resources/ resources/
COPY vite.config.js postcss.config.js tailwind.config.js ./
RUN npm run build

# ================================================
# STAGE 2: Install PHP Dependencies (Composer)
# ================================================
FROM composer:2 AS composer-builder

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --ignore-platform-reqs

COPY . .
RUN composer dump-autoload --optimize

# ================================================
# STAGE 3: Production Image (PHP-FPM + Nginx)
# ================================================
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    zip unzip libzip-dev \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    curl \
    && rm -rf /var/cache/apk/*

# Install PHP extensions yang dibutuhkan Laravel + DomPDF + Excel + ZipArchive
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    xml \
    gd \
    zip \
    intl \
    bcmath \
    opcache

# PHP Production Config
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/php.ini "$PHP_INI_DIR/conf.d/99-custom.ini"

# Nginx Config
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Supervisor Config (jalankan PHP-FPM + Nginx bersamaan)
COPY docker/supervisord.conf /etc/supervisord.conf

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY --from=composer-builder /app/vendor vendor/
COPY . .

# Copy built assets dari stage 1
COPY --from=node-builder /app/public/build public/build/

# Publish Livewire assets (agar nginx bisa membacanya secara statis)
RUN php artisan livewire:publish --assets

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Create required directories
RUN mkdir -p storage/logs \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/app/private_temp_zip \
    bootstrap/cache

# Entrypoint script
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
