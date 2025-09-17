<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>Home</title>
        <meta head-key="description" name="description" content="HextechPlay - plataforma de mini-games inspirado no universo de League of Legends – jogue, divirta-se e desafie seus amigos!" />
    </Head>

    <div>
        <section class="hero d-flex align-items-center justify-content-center text-center text-light">
            <div class="overlay"></div>
            <div class="container position-relative">
                <h1 class="display-3 fw-bold mb-3">Bem-vindo ao HextechPlay</h1>
                <p class="lead mb-4">Inspirado no universo de League of Legends – jogue, divirta-se e desafie seus amigos!</p>
                <Link :href="route('hub')" class="btn btn-primary btn-lg">Comece a jogar</Link>
            </div>
        </section>
    </div>
</template>

<style scoped>
.hero {
  position: relative;
  height: 100vh;
  background: url('https://wallpapers.com/images/hd/league-of-legends-background-a1iu7ppvueyfvfdw.jpg') center / cover no-repeat;
}
.overlay {
  position: absolute;
  inset: 0;
  background-color: rgba(11, 15, 20, 0.6); /* escurece a imagem para legibilidade */
}
.hero .container {
  z-index: 1;
  padding-top: 120px;
}
</style>
