import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    // server: {
    //     host: '0.0.0.0', // Ini memaksa Vite listen ke semua IP (Wi-Fi)
    //     cors: true,
    //     hmr: {
    //         host: '10.0.1.46', // GANTI DENGAN IP LAPTOP ANDA (Cek di cmd: ipconfig)
    //     },
    // },
});
