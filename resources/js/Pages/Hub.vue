<script setup>
import { Head, Link } from '@inertiajs/vue3'

// Exemplo de jogos — idealmente isso viria da sua API ou backend Laravel
const games = [
  {
    id: 1,
    title: 'Desafio de Reflexos',
    description: 'Reaja em milissegundos e prove sua habilidade.',
    image: 'https://a-static.besthdwallpaper.com/storm-dragon-lee-sin-league-of-legends-lol-wallpaper-2880x1800-72641_8.jpg',
    route: '#'
  },
]
</script>

<template>
  <Head title="Hub" />

  <div class="py-5 text-light vh-100 d-flex justify-content-center align-items-center">
    <div class="container">
      <div class="row g-4">
        <div v-for="game in games" :key="game.id" class="col-md-4">
          <div class="card h-100 shadow-lg border-0 hover-card">
            <img :src="game.image" class="card-img-top img-fluid" :alt="game.title" />
            <div class="card-body d-flex flex-column bg-gradient">
              <h4 class="card-title fw-bold mb-2">{{ game.title }}</h4>
              <p class="card-text small flex-grow-1">{{ game.description }}</p>
              <Link :href="game.route" class="btn btn-primary mt-auto">Jogar agora</Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
