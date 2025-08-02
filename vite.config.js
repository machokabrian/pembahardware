import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        // Set the output directory to 'dist' (default for most static site hosts like Vercel)
        outDir: 'dist',  // Ensure the build output goes into the 'dist' folder
    },
});
