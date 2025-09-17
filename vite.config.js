import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import purgeCss from 'vite-plugin-purgecss';

export default defineConfig({
    base: '/build/', // necessário em produção (Laravel serve /public/build)
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
        purgeCss({
            content: ['./resources/**/*.vue', './resources/**/*.blade.php'],
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources',
            'ziggy': path.resolve('vendor/tightenco/ziggy'),
        },
    },
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'hextechplay.com',
            protocol: 'wss',
            port: 5173,
        },
    },
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['vue', 'axios'], // separa bibliotecas grandes
                },
            },
        },
        cssCodeSplit: true, // divide css por página quando possível
    },
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "@/scss/_variables.scss";`
            }
        }
    }
});
