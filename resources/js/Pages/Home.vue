<script setup>
import { Head, Link } from '@inertiajs/vue3';

import heroBackground from '@/assets/images/wallpaper.jpg';
</script>

<template>
    <Head>
        <title>Home</title>
        <meta head-key="description" name="description" content="HextechPlay - plataforma de mini-games inspirado no universo de League of Legends – jogue, divirta-se e desafie seus amigos!" />
    </Head>

    <section class="hero d-flex align-items-center justify-content-center text-center text-light" style="position: relative; height: 100dvh; padding-top: env(safe-area-inset-top);" :style="{ background: `url(${heroBackground}) center / cover no-repeat` }">
        <div style="position: absolute; inset: 0; background-color: rgba(11, 15, 20, 0.6);"></div>
        <div class="position-relative" style="z-index: 1; padding-top: 120px;">
        <h1 class="display-3 fw-bold mb-3">Bem-vindo ao HextechPlay</h1>
        <p class="lead mb-4">Inspirado no universo de League of Legends – jogue, divirta-se e desafie seus amigos!</p>
        <Link :href="route('hub')" class="btn btn-primary btn-lg">Comece a jogar</Link>
        </div>
    </section>
</template>
