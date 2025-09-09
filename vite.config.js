import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue'; // Import the Vue plugin

export default defineConfig({
    plugins: [
        vue(), // Add the Vue plugin to the plugins array
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    resolve: {
            alias: {
                vue: 'vue/dist/vue.esm-bundler.js', // Alias for Vue 3
            },
        },
});
