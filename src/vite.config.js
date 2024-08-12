import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        strictPort: true,
        port: 5173,
        host: '0.0.0.0',
        origin: 'http://crocuscms.local:5173',
        hmr: {
            host: 'crocuscms.local',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin-app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
