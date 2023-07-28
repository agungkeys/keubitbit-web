// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import react from '@vitejs/plugin-react';

// export default defineConfig({
//     base: "./",
//     plugins: [
//         laravel({
//             input: [
//                 'resources/js/app.js',
//                 'resources/css/app.css'
//             ],
//             refresh: true,
//         }),
//         react(),
//     ],
//     build: {
//         manifest: true,
//         outDir: 'build',
//     },
// });


import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
