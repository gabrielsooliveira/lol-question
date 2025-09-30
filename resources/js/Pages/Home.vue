<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';

import heroBackground from '@/assets/images/wallpaper.jpg';
import homeImage2 from '@/assets/images/home-image-2.png';
import logo from '@/assets/images/icon.png';

const props = defineProps(["translations"]);
</script>

<template>
    <Head>
        <title>{{ props.translations.page_title }}</title>
        <meta head-key="description" name="description" :content="props.translations.page_description" />
        <meta name="keywords" content="mini-games, jogos online, quiz de runeterra, hextech, league of legends" />
        <meta name="author" content="HextechPlay Team" />
    </Head>

    <section class="hero d-flex align-items-center justify-content-center text-center text-light" style="position: relative; height: 100dvh; padding-top: env(safe-area-inset-top);" :style="{ background: `url(${heroBackground}) center / cover no-repeat` }">
        <div style="position: absolute; inset: 0; background-color: rgba(11, 15, 20, 0.85);"></div>
        <div class="position-relative container" style="z-index: 1; padding-top: 120px;">
            <img :src="logo" class="img-fluid" width="250">
            <h1 class="display-2 fw-bold mb-3">{{ props.translations.play_phrase }}</h1>
            <p class="lead mb-4">{{ props.translations.play_phrase_sub }}</p>
            <Link :href="route('menu')" class="btn btn-warning bg-gradient btn-lg border-0 fw-bold">
                {{ props.translations.play_button }}
            </Link>
        </div>
    </section>

    <section class="bg-light">
        <div class="container text-dark">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1">
                    <div class="mt-1 mt-lg-0">
                        <h2 class="fw-bold display-1">{{ props.translations.home_about_title }}</h2>
                        <p class="fw-semibold">{{ props.translations.home_about_description }}</p>
                        <ul class="list-unstyled">
                            <li class="mb-2">🎮 {{ props.translations.home_feature_free_games }}</li>
                            <li class="mb-2">🌌 {{ props.translations.home_feature_lol_universe }}</li>
                            <li class="mb-2">📱 {{ props.translations.home_feature_multiplatform }}</li>
                            <li class="mb-2">⚡ {{ props.translations.home_feature_updates }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2">
                    <img :src="homeImage2" class="img-fluid pe-none" :alt="props.translations.home_about_image_alt" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <footer class="bottom-0 w-100 text-center text-white py-2 ">
        <div class="container">
            <p class="mb-2">
            {{ props.translations.footer_description }}
            </p>
            <div>
                <Link :href="route('privacy.policy')" class="text-white">
                {{ props.translations.privacy_policy }}
                </Link>
            </div>
        </div>
    </footer>
</template>

