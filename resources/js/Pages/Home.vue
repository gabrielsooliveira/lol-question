<script setup>
import { Head, Link } from '@inertiajs/vue3';

import heroBackground from '@/assets/images/wallpaper.jpg';
import homeImage from '@/assets/images/home-image.png';
import homeImage2 from '@/assets/images/home-image-2.png';
import logo from '@/assets/images/icon.png';
</script>

<template>
    <Head>
        <title>{{ $page.props.translations.page_title }}</title>
        <meta head-key="description" name="description" :content="$page.props.translations.page_description" />
        <meta name="keywords" content="mini-games, jogos online, quiz de runeterra, hextech, league of legends" />
        <meta name="author" content="HextechPlay Team" />
    </Head>

    <section class="hero d-flex align-items-center justify-content-center text-center text-light" style="position: relative; height: 100dvh; padding-top: env(safe-area-inset-top);" :style="{ background: `url(${heroBackground}) center / cover no-repeat` }">
        <div style="position: absolute; inset: 0; background-color: rgba(11, 15, 20, 0.85);"></div>
        <div class="position-relative container" style="z-index: 1; padding-top: 120px;">
            <img :src="logo" class="img-fluid" width="250">
            <h1 class="display-2 fw-bold mb-3">{{ $page.props.translations['play_phrase'] }}</h1>
            <p class="lead mb-4">{{ $page.props.translations['play_phrase-sub'] }}</p>
            <Link :href="route('menu')" class="btn btn-warning bg-gradient btn-lg border-0 fw-bold">
                {{ $page.props.translations['play_button'] }}
            </Link>
        </div>
    </section>

    <section class="container text-light">
        <div class="row">
            <div class="mt-4 mt-lg-0 d-flex">
                <div class="z-2">
                    <h2 class="fw-bold display-1">O que é o HextechPlay?</h2>
                </div>
                <div class="position-absolute offset-lg-4">
                    <img :src="homeImage" class="img-fluid d-none d-lg-block" width="590" alt="Imagem ilustrativa do HextechPlay">
                </div>
            </div>

            <div class="mt-1 mt-lg-0 col-lg-6">
                <p class="fw-semibold">O HextechPlay é uma plataforma de mini-games rápidos e divertidos, inspirados no universo dos games. Aqui você pode testar seus conhecimentos, desafiar seus amigos e se divertir em qualquer dispositivo.</p>
                <ul class="list-unstyled ">
                    <li class="mb-2">🎮 Jogos gratuitos e exclusivos</li>
                    <li class="mb-2">🌌 Inspirado no universo dos games</li>
                    <li class="mb-2">📱 Funciona em computador e celular</li>
                    <li class="mb-2">⚡ Atualizações frequentes com novos desafios</li>
                </ul>
            </div>
        </div>
    </section>

    <footer class="bottom-0 w-100 text-center text-white py-2 mt-3">
        <div class="container">
            <p class="mb-2">
            HextechPlay é uma plataforma de mini-games gratuitos inspirados no universo dos games.
            Jogue, divirta-se e desafie seus amigos online!
            </p>
            <div>
                <Link :href="route('privacy.policy')" class="text-white">
                {{ $page.props.translations['privacy_policy'] }}
                </Link>
            </div>
        </div>
    </footer>
</template>

