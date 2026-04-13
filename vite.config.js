import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});

// import { defineConfig } from 'vite'
// import laravel from 'laravel-vite-plugin'

// export default defineConfig({
//     server: {
//         host: '0.0.0.0',
//         port: 5173,
//         strictPort: true,
//         hmr: {
//             host: '172.20.10.3',
//         },
//     },
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// })

// // npm run dev -- --port 5174
// // php artisan serve --host=172.20.10.3 --port=8000