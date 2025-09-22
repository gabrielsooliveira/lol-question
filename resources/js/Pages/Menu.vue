<script setup>
import { Head, Link } from '@inertiajs/vue3'
import LolQuestionBackground from '@/assets/images/lolquestion.jpg';

const games = [
  {
    id: 1,
    title: 'LoreQuestion',
    image: LolQuestionBackground,
    route: 'lorequestion.index'
  },
]
</script>

<template>
    <Head>
        <title>Menu</title>
        <meta head-key="description" name="description" content="Menu de jogos da HextechPlay para você se divertir" />
    </Head>

    <div class="py-5 text-light vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
        <div class="row g-4">
            <div v-for="game in games" :key="game.id" class="col-md-4">
            <div class="card h-100 shadow hover-card">
                <img :src="game.image" class="card-img-top img-fluid" :alt="game.title" loading="lazy" />
                <div class="card-body d-flex flex-column bg-gradient">
                <h4 class="card-title fw-bold mb-2">{{ game.title }}</h4>
                <Link :href="route(game.route)" class="btn btn-primary mt-auto">Jogar agora</Link>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>
