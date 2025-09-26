<script setup>
import { Head, Link } from '@inertiajs/vue3';

import heroBackground from '@/assets/images/wallpaper.jpg';
import logo from '@/assets/images/icon.png';
</script>

<template>
    <Head>
        <title>{{ $page.props.translations.page_title }}</title>
        <meta head-key="description" name="description" :content="$page.props.translations.page_description" />
    </Head>

    <section class="hero d-flex align-items-center justify-content-center text-center text-light" style="position: relative; height: 100dvh; padding-top: env(safe-area-inset-top);" :style="{ background: `url(${heroBackground}) center / cover no-repeat` }">
        <div style="position: absolute; inset: 0; background-color: rgba(11, 15, 20, 0.85);"></div>
        <div class="position-relative" style="z-index: 1; padding-top: 120px;">
            <img :src="logo" class="img-fluid" width="250">
            <h1 class="display-4 fw-bold mb-3">{{ $page.props.translations['play_phrase'] }}</h1>
            <p class="lead mb-4">{{ $page.props.translations['play_phrase-sub'] }}</p>
            <Link :href="route('menu')" class="btn btn-warning bg-gradient btn-lg border-0 fw-bold">
                {{ $page.props.translations['play_button'] }}
            </Link>
        </div>
    </section>
</template>

