import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import purgeCss from 'vite-plugin-purgecss';
import viteImagemin from 'vite-plugin-imagemin';

export default defineConfig({
    // base: '/build/',
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
        viteImagemin({
            gifsicle: {
                optimizationLevel: 7,
                interlaced: false,
            },
            optipng: {
                optimizationLevel: 7,
            },
            mozjpeg: {
                quality: 75,
            },
            pngquant: {
                quality: [0.65, 0.9],
                speed: 4,
            },
            svgo: {
                plugins: [
                {
                    name: 'removeViewBox',
                },
                {
                    name: 'removeEmptyAttrs',
                    active: false,
                },
                ],
            },
            webp: {
                quality: 75,
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
        host: 'localhost',
        port: 5173,
        // strictPort: true,
        // hmr: {
        //     host: 'hextechplay.com',
        //     protocol: 'wss',
        //     port: 5173,
        // },
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
