import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources',
            'ziggy': path.resolve('vendor/tightenco/ziggy'),
        },
    },
    server: {
        host: '0.0.0.0', // expõe para o host
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost', // navegador acessa
            port: 5173,
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "@/scss/_variables.scss";`
            }
        }
    }
});
