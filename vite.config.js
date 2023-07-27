import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    base: "./",
    plugins: [
        laravel({
            input: [
                'resources/js/app.jsx',
                'resources/css/app.css',
                'resources/sass/app.scss',
            ],
            refresh: true,
            publicDirectory: 'public',
        }),
        react(),
    ],
    build: {
        chunkSizeWarningLimit: 1000,
    },
});
