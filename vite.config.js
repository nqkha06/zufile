import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
    host: '0.0.0.0',
    port: 5173,
    hmr: {
      host: 'localhost', // hoặc IP máy thật
      protocol: 'ws',
    },
  },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
