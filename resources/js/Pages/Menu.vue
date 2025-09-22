<script setup>
import { Head, Link } from '@inertiajs/vue3';
import LolQuestionBackground from '@/assets/images/lolquestion.jpg';

const games = [
  {
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
                <div v-for="(game, index) in games" :key="index" class="col-md-4">
                    <div class="card text-bg-dark shadow hover-card">
                        <Link :href="route(game.route)">
                            <img :src="game.image" class="card-img" :alt="game.title" loading="lazy">
                            <div class="card-img-overlay">
                                <h4 class="card-title text-white fw-bold">{{ game.title }}</h4>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
