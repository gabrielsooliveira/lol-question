<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';
import LolQuestionBackground from '@/assets/images/lorequestion.png';
import WordLoLBackground from '@/assets/images/wordlol.png';

const { t } = useI18n(); // <-- hook do i18n

const searchQuery = ref('');
const selectedDifficulty = ref('all');
const selectedCategory = ref('all');
const isVisible = ref(false);

const games = ref([
  {
    id: 1,
    title: t('lorequestion_title'),
    description: t('lorequestion_desc'),
    image: LolQuestionBackground,
    route: 'lorequestion.index',
    category: 'quiz',
    players: 2500,
    rating: 4.8,
    duration: '5-10 min',
    tags: ['lore', 'conhecimento', 'runeterra'],
    featured: true
  },
  {
    id: 2,
    title: t('wordlol_title'),
    description: t('wordlol_desc'),
    image: WordLoLBackground,
    route: 'wordlol.game',
    category: 'word',
    players: 1800,
    rating: 4.6,
    duration: '3-8 min',
    tags: ['palavras', 'campeões', 'adivinhação'],
    featured: false
  }
]);

// Filters
const difficulties = [
  { value: 'all', label: t('all_difficulties') },
  { value: 'easy', label: t('easy') },
  { value: 'medium', label: t('medium') },
  { value: 'hard', label: t('hard') }
];

const categories = [
  { value: 'all', label: t('all_categories') },
  { value: 'quiz', label: t('quiz') },
  { value: 'word', label: t('word') },
  { value: 'memory', label: t('memory') },
  { value: 'puzzle', label: t('puzzle') }
];

// Computed
const filteredGames = computed(() => games.value.filter(game => {
  const matchesSearch = game.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                        game.description.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                        game.tags.some(tag => tag.toLowerCase().includes(searchQuery.value.toLowerCase()));
  const matchesDifficulty = selectedDifficulty.value === 'all' || game.difficulty === selectedDifficulty.value;
  const matchesCategory = selectedCategory.value === 'all' || game.category === selectedCategory.value;
  return matchesSearch && matchesDifficulty && matchesCategory;
}));

const featuredGames = computed(() => games.value.filter(game => game.featured));
const popularGames = computed(() => [...games.value].sort((a, b) => b.players - a.players).slice(0,3));

// Helpers
const getDifficultyColor = diff => ({ easy:'success', medium:'warning', hard:'danger' }[diff] || 'secondary');
const clearFilters = () => { searchQuery.value=''; selectedDifficulty.value='all'; selectedCategory.value='all'; }

onMounted(() => isVisible.value = true);
</script>

<template>
    <Head>
        <title>{{ $t('page_title') }}</title>
        <meta name="description" :content="$t('page_description')" />
        <meta name="keywords" :content="$t('page_keywords')" />
        <meta property="og:title" :content="$t('og_title')" />
        <meta property="og:description" :content="$t('og_description')" />
        <meta property="og:url" content="https://hextechplay.com/games" />
        <link rel="canonical" href="https://hextechplay.com/games" />
    </Head>

  <section class="games-hero py-5 mt-5 text-center">
    <div class="container mt-5">
      <h1 class="display-3 fw-bold mb-3 fade-in" :class="{ 'slide-in-left': isVisible }">
        {{ t('choose_game') }}
      </h1>
      <p class="lead text-light opacity-75 fade-in delay-200" :class="{ 'slide-in-right': isVisible }">
        {{ t('choose_game_subtitle') }}
      </p>

      <div class="d-flex justify-content-center flex-wrap mt-4 fade-in delay-300" :class="{ 'slide-in-left': isVisible }">
        <div class="stat-badge me-2 mb-2">
          <font-awesome-icon icon="fas fa-gamepad" class="text-accent me-1"></font-awesome-icon> {{ games.length }} {{ t('games') }}
        </div>
        <div class="stat-badge me-2 mb-2">
          <font-awesome-icon icon="fas fa-users" class="text-accent me-1"></font-awesome-icon> {{ games.reduce((sum,g)=>sum+g.players,0).toLocaleString() }} {{ t('players') }}
        </div>
        <div class="stat-badge me-2 mb-2">
          <font-awesome-icon icon="fas fa-star" class="text-accent me-1"></font-awesome-icon> {{ (games.reduce((sum,g)=>sum+g.rating,0)/games.length).toFixed(1) }} {{ t('rating') }}
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Games -->
  <section class="featured-section py-5 bg-glass" v-if="featuredGames.length">
    <div class="container">
      <h2 class="section-title mb-3">
        {{ t('featured_games') }}
      </h2>
      <p class="text-light opacity-75 mb-4">{{ t('featured_games_subtitle') }}</p>
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4" v-for="game in featuredGames" :key="game.id">
          <div class="card card-game featured h-100">
            <div class="card-img-wrapper">
              <img :src="game.image" class="card-img-top" :alt="game.title">
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span>{{ game.title }}</span>
                <div class="rating"><font-awesome-icon icon="fas fa-star" class="text-warning me-1"></font-awesome-icon>{{ game.rating }}</div>
              </div>
              <p class="card-text text-light text-truncate opacity-75">{{ game.description }}</p>
              <div class="game-meta mb-3">
                <span :class="`badge bg-${getDifficultyColor(game.difficulty)} me-2`">{{ game.difficulty }}</span>
                <span class="badge bg-secondary me-2">{{ game.category }}</span>
                <span class="badge bg-info">{{ game.duration }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-secondary"><font-awesome-icon icon="fas fa-users me-1"></font-awesome-icon> {{ game.players.toLocaleString() }}</small>
                <Link :href="route(game.route)" class="btn btn-accent btn-sm hover-lift"><font-awesome-icon icon="fas fa-play me-1"></font-awesome-icon> {{ t('play') }}</Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Filters Section -->
  <section class="filters-section py-4">
    <div class="container">
      <div class="filters-card bg-glass p-4 rounded-3">
        <div class="row g-3">
          <div class="col-md-4">
            <div class="position-relative">
              <input v-model="searchQuery" type="text" class="form-control ps-5 bg-glass text-light" :placeholder="t('search_games')">
            </div>
          </div>
          <div class="col-md-3">
            <select v-model="selectedDifficulty" class="form-select bg-glass text-light">
              <option v-for="d in difficulties" :key="d.value" :value="d.value">{{ d.label }}</option>
            </select>
          </div>
          <div class="col-md-3">
            <select v-model="selectedCategory" class="form-select bg-glass text-light">
              <option v-for="c in categories" :key="c.value" :value="c.value">{{ c.label }}</option>
            </select>
          </div>
          <div class="col-md-2">
            <button @click="clearFilters" class="btn btn-outline-secondary w-100"><font-awesome-icon icon="fas fa-times" class="me-1"></font-awesome-icon> {{ t('clear') }}</button>
          </div>
        </div>
      </div>
    </div>
  </section>

    <section class="games-grid py-5">
        <div class="container">
            <div class="row mb-4 align-items-center">
                <div class="col-6"><h3 class="text-light mb-0">{{ $t('all_games') }} <span class="text-accent">({{ filteredGames.length }})</span></h3></div>
            </div>
            <div class="row" v-if="filteredGames.length">
                <div class="col-lg-4 col-md-6 mb-4" v-for="game in filteredGames" :key="game.id">
                    <div class="card card-game featured h-100">
                    <div class="card-img-wrapper">
                        <img :src="game.image" class="card-img-top" :alt="game.title">
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ game.title }}</span>
                        <div class="rating"><font-awesome-icon icon="fas fa-star" class="text-warning me-1"></font-awesome-icon>{{ game.rating }}</div>
                    </div>
                    <p class="card-text text-light text-truncate opacity-75">{{ game.description }}</p>
                            <div class="game-meta mb-3">
                                <span :class="`badge bg-${getDifficultyColor(game.difficulty)} me-2`">{{ game.difficulty }}</span>
                                <span class="badge bg-secondary me-2">{{ game.category }}</span>
                                <span class="badge bg-info">{{ game.duration }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-secondary"><font-awesome-icon icon="fas fa-users me-1"></font-awesome-icon> {{ game.players.toLocaleString() }}</small>
                                <Link :href="route(game.route)" class="btn btn-accent btn-sm hover-lift"><font-awesome-icon icon="fas fa-play" class="me-1"></font-awesome-icon> {{ t('play') }}</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="text-center py-5 text-light">
                <font-awesome-icon icon="fas fa-search" class="mb-3 fs-2"></font-awesome-icon>
                <h4>Nenhum jogo encontrado</h4>
                <p class="opacity-75">Ajuste os filtros ou busque por outro termo.</p>
                <button @click="clearFilters" class="btn btn-accent"><font-awesome-icon icon="fas fa-refresh" class="me-1"></font-awesome-icon> Limpar Filtros</button>
            </div>
        </div>
    </section>
</template>

<style scoped>
.games-hero { padding-top: 120px; background: linear-gradient(135deg, rgba(17,24,39,.9), rgba(15,23,42,.8)); text-align:center; }
.stat-badge { display:inline-flex; align-items:center; padding:.5rem 1rem; border-radius:2rem; backdrop-filter:blur(10px); border:1px solid rgba(59,130,246,.2); margin:.25rem; transition:.3s; }
.stat-badge:hover{transform:translateY(-2px);border-color:rgba(59,130,246,.4);}
.filters-card{backdrop-filter:blur(10px); border:1px solid rgba(59,130,246,.2);}
.search-icon{position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:rgba(249,250,251,.6);}
.card-img-wrapper{position:relative; overflow:hidden; height:200px;}
.card-img-top{height:100%; object-fit:cover; transition:.3s;}
.card-game:hover .card-img-top{transform:scale(1.05);}
.card-overlay{position:absolute;top:0;left:0;width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.3);opacity:0;transition:.3s;}
.card-game:hover .card-overlay{opacity:1;}
.featured-badge{position:absolute;top:1rem;left:1rem;width:40px;height:40px;background:linear-gradient(135deg,#F59E0B,#D97706);display:flex;align-items:center;justify-content:center;border-radius:50%;color:#fff;}
.bg-glass{backdrop-filter:blur(10px);}

.hover-lift{transition:.3s;}
.hover-lift:hover{transform:translateY(-2px);}
@media (max-width:767.98px){.games-hero{padding-top:100px;}.card-img-wrapper{height:150px;}}
</style>
