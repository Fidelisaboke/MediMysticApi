import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS
                'resources/css/home.css', 
                'resources/css/sign_in.css',
                
                // JS
                'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
