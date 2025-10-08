<script setup>
import { defineProps } from 'vue'

// const props = defineProps({
//   partners: Array
// })

const partners = [
  {
    id: 1,
    name: "StreamerNami",
    platform: "Twitch",
    link: "https://twitch.tv/streamernami",
    avatar: "https://dummyimage.com/600x400/000/fff",
    description: "Gameplay divertida e muito amor pelo LoL!",
    featured: true
  },
  {
    id: 2,
    name: "HexLord",
    platform: "YouTube",
    link: "https://youtube.com/@HexLord",
    avatar: "https://dummyimage.com/600x400/000/fff",
    description: "Vídeos e desafios do HextechPlay toda semana!",
    featured: false
  },
  {
    id: 3,
    name: "KickRiven",
    platform: "Kick",
    link: "https://kick.com/kickriven",
    avatar: "https://dummyimage.com/600x400/000/fff",
    description: "Lives de LoL e bate-papo sobre o universo Hextech!",
    featured: true
  },
  {
    id: 4,
    name: "Jinxada",
    platform: "Twitch",
    link: "https://twitch.tv/jinxada",
    avatar: "https://dummyimage.com/600x400/000/fff",
    description: "A energia da Jinx em cada partida — diversão garantida!",
    featured: false
  },
  {
    id: 5,
    name: "TechLux",
    platform: "YouTube",
    link: "https://youtube.com/@TechLux",
    avatar: "https://dummyimage.com/600x400/000/fff",
    description: "Tutoriais e reviews sobre o HextechPlay!",
    featured: false
  }
];

</script>

<template>
  <div class="container py-5 mt-5">
    <h1 class="text-center fw-bold mb-4 display-6 mt-5">Parceiros de Stream</h1>

    <div class="row g-4">
      <div
        v-for="partner in partners"
        :key="partner.id"
        class="col-12 col-sm-6 col-md-4 col-lg-3"
      >
        <div class="card h-100 shadow-sm border-0 text-center">
          <div class="card-body">
            <img
              :src="partner.avatar || '/images/default-avatar.png'"
              alt="Avatar"
              class="rounded-circle mb-3 object-fit-cover"
              style="width: 80px; height: 80px;"
            />

            <h5 class="card-title mb-1">{{ partner.name }}</h5>
            <p class="text-muted small mb-2">{{ partner.platform }}</p>

            <p class="card-text small text-secondary mb-3">
              {{ partner.description || 'Parceiro do HextechPlay!' }}
            </p>

            <a
              :href="partner.link"
              target="_blank"
              class="btn btn-sm btn-outline-primary"
            >
              Visitar Canal
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

