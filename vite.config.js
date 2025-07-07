import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
            'node_modules/admin-lte/dist/css/adminlte.css',
            'node_modules/admin-lte/dist/js/adminlte.js',
        ]),
    ],
});
