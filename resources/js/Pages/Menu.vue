<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import LolQuestionBackground from '@/assets/images/lorequestion.png';
import HangmanBackground from '@/assets/images/hangman.png';

const props = defineProps(["translations"]);

const games = [
  {
    title: props.translations.lorequestion_title,
    description: props.translations.lorequestion_desc,
    image: LolQuestionBackground,
    route: 'lorequestion.index'
  },
  {
    title: props.translations.hangman_title,
    description: props.translations.hangman_desc,
    image: HangmanBackground,
    route: 'hangman.index'
  },
];
</script>

<template>
  <Head>
    <title>{{ props.translations.page_title }}</title>
    <meta head-key="description" name="description" :content="props.translations.page_description" />
    <meta name="keywords" content="mini-games, jogos online, quiz de runeterra, hangman, lore question" />
    <meta name="author" content="HextechPlay Team" />
    <meta property="og:title" content="Jogos - HextechPlay" />
    <meta property="og:description" :content="props.translations.page_description" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://hextechplay.com/menu" />
  </Head>

  <!-- Seção introdutória -->
  <section class="container text-light text-center py-5">
    <h2 class="fw-bold mt-4">{{ props.translations.choose_game }}</h2>
    <p>{{ props.translations.choose_game_subtitle }}</p>
  </section>

  <!-- Lista de jogos -->
  <section class="container py-4">
    <div class="row g-4">
      <div v-for="(game, index) in games" :key="index" class="col-md-4">
        <div class="card text-bg-dark shadow hover-card h-100 position-relative">
          <img :src="game.image" class="card-img opacity-25" :alt="game.title" loading="lazy">
          <div class="card-img-overlay d-flex flex-column justify-content-end p-3 bg-dark bg-opacity-50">
            <h4 class="card-title text-white fw-bold">{{ game.title }}</h4>
            <p class="card-text text-white fw-semibold">{{ game.description }}</p>
            <Link :href="route(game.route)" class="btn btn-warning mt-2 text-capitalize">{{ $page.props.translations['play'] }}</Link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
