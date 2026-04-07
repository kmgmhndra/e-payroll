#!/bin/sh
set -e

echo "========================================="
echo "  Kemenkum Payroll - Starting..."
echo "========================================="

cd /var/www/html

# 1. Siapkan file .env jika belum ada
if [ ! -f .env ]; then
    echo "[*] Creating .env from .env.example..."
    cp .env.example .env
fi

if [ -z "$APP_KEY" ]; then
    echo "[*] Generating APP_KEY..."
    php artisan key:generate --force
fi

# 2. Cache config & routes (Production optimization)
echo "[*] Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Jalankan migrasi database
echo "[*] Running database migrations..."
php artisan migrate --force

# 4. Fix permissions
echo "[*] Setting permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# 5. Link storage
php artisan storage:link 2>/dev/null || true

echo "========================================="
echo "  Kemenkum Payroll - Ready!"
echo "  Akses di: http://localhost:8080"
echo "========================================="

# Jalankan CMD (supervisord)
exec "$@"
