import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import LaravelVitePlugin from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        // LaravelVitePlugin(),
    ],
    build: {
        rollupOptions: {
            input: {
                main: './resources/views/main.blade.php', // Ruta a tu vista principal
            },
        },
        outDir: 'public/build',
        manifest: true,
    },
});

// export default {
//     build: {
//         publicDir: '../public',
//     },
// };


