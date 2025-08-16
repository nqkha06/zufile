import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/pages/drive.js',

      ],
      refresh: true,
    }),

  ],
   server: {
        host: '0.0.0.0', // bắt buộc để listen mọi IP
        port: 5173,
        hmr: {
            host: 'localhost', // hoặc IP máy host (vd: 192.168.x.x)
        }
    }
});
