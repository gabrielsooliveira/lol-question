<script setup>
import { Head, Link } from '@inertiajs/vue3'

const games = [
  {
    id: 1,
    title: 'LoreQuestion',
    description: 'Saiba se vocês conhece sobre as histórias do league of legends.',
    image: 'https://i.pinimg.com/736x/b6/19/06/b619062a4a25aa7dec395815c0849ae4.jpg',
    route: 'lorequestion.index'
  },
]
</script>

<template>
    <Head>
        <title>Hub</title>
        <meta head-key="description" name="description" content="Hub de jogos da HextechPlay para você se divertir" />
    </Head>

    <div class="py-5 text-light vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
        <div class="row g-4">
            <div v-for="game in games" :key="game.id" class="col-md-4">
            <div class="card h-100 shadow hover-card">
                <img :src="game.image" class="card-img-top img-fluid" :alt="game.title" loading="lazy" />
                <div class="card-body d-flex flex-column bg-gradient">
                <h4 class="card-title fw-bold mb-2">{{ game.title }}</h4>
                <p class="card-text small flex-grow-1">{{ game.description }}</p>
                <Link :href="route(game.route)" class="btn btn-primary mt-auto">Jogar agora</Link>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>
