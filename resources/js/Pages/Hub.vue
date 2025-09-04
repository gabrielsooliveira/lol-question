<script setup>
import { Head, Link } from '@inertiajs/vue3'

const games = [
  {
    id: 1,
    title: 'LoreQuestion',
    description: 'Saiba se vocês conhece sobre as histórias do league of legends.',
    image: 'https://a-static.besthdwallpaper.com/storm-dragon-lee-sin-league-of-legends-lol-wallpaper-2880x1800-72641_8.jpg',
    route: 'lorequestion.index'
  },
]
</script>

<template>
    <Head title="Hub" />

    <div class="py-5 text-light vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
        <div class="row g-4">
            <div v-for="game in games" :key="game.id" class="col-md-4">
            <div class="card h-100 shadow-lg border-0">
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
