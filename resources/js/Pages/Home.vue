<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

import heroBackground from "@/assets/images/wallpaper.jpg";
import homeImage2 from "@/assets/images/home-image-2.png";
import logo from "@/assets/images/icon.png";
import LolQuestionBackground from "@/assets/images/lorequestion.png";
import HangmanBackground from "@/assets/images/hangman.png";
import { useI18n } from 'vue-i18n';

// Configurar i18n
const { t } = useI18n();
// Animation states
const isVisible = ref(false);
const statsVisible = ref(false);

const stats = ref([
    { value: 250, target: 10000, label: t('stats.active_players'), icon: "users" },
    { value: 2, target: 2, label: t('stats.mini_games'), icon: "gamepad" },
    { value: 850, target: 1000000, label: t('stats.matches_played'), icon: "trophy" },
    { value: 90, target: 99, label: t('stats.satisfaction'), icon: "star", suffix: "%" },
]);

const featuredGames = ref([
    {
        id: 1,
        title: t('featured_games.lorequestion.title'),
        description: t('featured_games.lorequestion.description'),
        image: LolQuestionBackground,
        route: "lorequestion.index",
        players: 2500,
    },
    {
        id: 2,
        title: t('featured_games.runeterraguess.title'),
        description: t('featured_games.runeterraguess.description'),
        image: HangmanBackground,
        route: "hangman.index",
        players: 1800,
    },
]);

const recentAchievements = ref([
    {
        id: 1,
        title: t('achievements.master_lore.title'),
        description: t('achievements.master_lore.description'),
        icon: "crown",
        rarity: "legendary",
    },
    {
        id: 2,
        title: t('achievements.speedster.title'),
        description: t('achievements.speedster.description'),
        icon: "bolt",
        rarity: "epic",
    },
    {
        id: 3,
        title: t('achievements.explorer.title'),
        description: t('achievements.explorer.description'),
        icon: "map",
        rarity: "rare",
    },
]);

// Animate stats
const animateStats = () => {
    stats.value.forEach((stat) => {
        const duration = 2000;
        const increment = stat.target / (duration / 16);
        const timer = setInterval(() => {
            if (stat.value < stat.target) {
                stat.value = Math.min(stat.value + increment, stat.target);
            } else {
                stat.value = stat.target;
                clearInterval(timer);
            }
        }, 16);
    });
};

const handleScroll = () => {
    const statsSection = document.querySelector(".stats-section");
    if (statsSection && !statsVisible.value) {
        const rect = statsSection.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
            statsVisible.value = true;
            animateStats();
        }
    }
};

onMounted(() => {
    isVisible.value = true;
    window.addEventListener("scroll", handleScroll);
});
</script>

<template>
    <Head>
        <title>{{ $t("page_title") }}</title>
        <meta head-key="description" name="description" :content="$t('page_description')" />
        <meta name="keywords" content="mini-games, jogos online, quiz de runeterra, hextech, league of legends" />
        <meta name="author" content="HextechPlay Team" />
    </Head>

    <section
        class="hero-section d-flex align-items-center justify-content-center text-center text-light position-relative"
        :style="{
            background: `linear-gradient(rgba(17, 24, 39, 0.8), rgba(15, 23, 42, 0.9)), url(${heroBackground}) center / cover no-repeat`,
            minHeight: '100vh',
            paddingTop: 'env(safe-area-inset-top)',
        }">
        <div class="container position-relative" style="z-index: 10; padding-top: 120px">
            <!-- Logo -->
            <div class="hero-logo mb-4" :class="{ 'fade-in': isVisible }">
                <img :src="logo" class="img-fluid hover-scale" width="280" alt="HextechPlay Logo" />
            </div>

            <!-- Title & Subtitle -->
            <h1 class="hero-title display-1 fw-bold mb-4 text-glow slide-in-left delay-200"
                :class="{ 'fade-in': isVisible }">
                {{ $t("play_phrase") }}
            </h1>
            <p class="hero-subtitle lead mb-5 slide-in-right delay-300" :class="{ 'fade-in': isVisible }">
                {{ $t("play_phrase_sub") }}
            </p>

            <!-- CTA Buttons -->
            <div class="hero-actions slide-in-left delay-400" :class="{ 'fade-in': isVisible }">
                <Link :href="route('menu')" class="btn btn-accent btn-lg me-3 mb-3 hover-lift">
                <font-awesome-icon icon="fas fa-play" class="me-2"></font-awesome-icon>
                {{ $t("play_button") }}
                </Link>
            </div>
        </div>
    </section>

    <section class="featured-games-section py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="section-title display-4 fw-bold text-gradient mb-3">
                        {{ $t('featured_games_title') }}
                    </h2>
                    <p class="section-subtitle text-light opacity-75 lead">
                        {{ $t('featured_games_subtitle') }}
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4" v-for="(game, index) in featuredGames" :key="game.id">
                    <div class="card card-game h-100 fade-in" :class="`delay-${(index + 1) * 100}`">
                        <div class="card-img-wrapper position-relative">
                            <img :src="game.image" class="card-img-top" :alt="game.title" loading="lazy" />
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <font-awesome-icon :icon="`fas fa-${game.icon}`" class="text-accent me-2"></font-awesome-icon>
                                <h5 class="card-title mb-0">
                                    {{ game.title }}
                                </h5>
                            </div>
                            <p class="card-text text-light opacity-75 mb-3">
                                {{ game.description }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-secondary"><font-awesome-icon icon="fas fa-users" class="me-1"></font-awesome-icon>
                                    {{ game.players.toLocaleString() }}
                                    {{ $t('players') }}</small>
                                <Link :href="route(game.route)" class="btn btn-sm btn-accent"><font-awesome-icon icon="fas fa-play"></font-awesome-icon>
                                {{ $t('play_game_button') }}</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section py-5 bg-glass">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="section-title display-4 fw-bold text-gradient mb-3">
                        {{ $t('community_title') }}
                    </h2>
                    <p class="section-subtitle text-light opacity-75 lead">
                        {{ $t('community_subtitle') }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4" v-for="(stat, index) in stats" :key="stat.label">
                    <div class="stat-card text-center h-100 fade-in" :class="`delay-${(index + 1) * 100}`">
                        <div class="stat-icon-large mb-3">
                            <font-awesome-icon :icon="`fas fa-${stat.icon}`" class="text-accent"></font-awesome-icon>
                        </div>
                        <div class="stat-value-large text-gradient fw-bold mb-2">
                            {{ Math.floor(stat.value).toLocaleString()
                            }}{{ stat.suffix || "" }}
                        </div>
                        <div class="stat-label-large text-light">
                            {{ stat.label }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                    <img :src="homeImage2" class="img-fluid hover-scale" :alt="$t('home_about_image_alt')"
                        loading="lazy" />
                </div>
                <div class="col-lg-6 order-lg-1">
                    <h2 class="section-title display-4 fw-bold text-gradient mb-4">
                        {{ $t("home_about_title") }}
                    </h2>
                    <p class="section-description text-light opacity-75 lead mb-4">
                        {{ $t("home_about_description") }}
                    </p>
                    <div class="features-list">
                        <div class="feature-item d-flex align-items-center mb-3" v-for="feat in [
                            {
                                icon: 'gamepad',
                                text: $t('home_feature_free_games'),
                            },
                            {
                                icon: 'globe',
                                text: $t('home_feature_lol_universe'),
                            },
                            {
                                icon: 'mobile-alt',
                                text: $t('home_feature_multiplatform'),
                            },
                            {
                                icon: 'bolt',
                                text: $t('home_feature_updates'),
                            },
                        ]" :key="feat.text">
                            <div class="feature-icon me-3">
                                <font-awesome-icon :icon="`fas fa-${feat.icon}`" class="text-accent"></font-awesome-icon>
                            </div>
                            <span class="text-light">{{ feat.text }}</span>
                        </div>
                    </div>
                    <Link :href="route('menu')" class="btn btn-accent btn-lg hover-lift mt-3">
                    <font-awesome-icon icon="fas fa-rocket" class="me-2"></font-awesome-icon>
                    {{ $t('get_started_button') }}
                    </Link>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="achievements-section py-5 bg-glass">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="section-title display-4 fw-bold text-gradient mb-3">
                       {{ $t('achievements_title') }}
                    </h2>
                    <p class="section-subtitle text-light opacity-75 lead">
                        {{ $t('achievements_subtitle') }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4" v-for="(achievement, index) in recentAchievements"
                    :key="achievement.id">
                    <div class="card card-achievement h-100 unlocked fade-in" :class="`delay-${(index + 1) * 100}`">
                        <div class="card-body text-center">
                            <div class="achievement-icon mb-3">
                                <font-awesome-icon :icon="`fas fa-${achievement.icon}`"></font-awesome-icon>
                            </div>
                            <h5 class="achievement-title text-light mb-2">
                                {{ achievement.title }}
                            </h5>
                            <p class="achievement-description mb-3">
                                {{ achievement.description }}
                            </p>
                            <span :class="`badge rarity-${achievement.rarity}`">
                                {{
                                    achievement.rarity === 'legendary'
                                        ? $t('rarity_legendary')
                                        : achievement.rarity === 'epic'
                                            ? $t('rarity_epic')
                                            : $t('rarity_rare')
                                }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
/* Mantive efeitos, glassmorphism e responsividade do padrão anterior */

/* Hero Section */
.hero-section {
    position: relative;
    overflow: hidden;
}

.hero-logo {
    transition: all 0.5s ease;
}

.hover-scale {
    transition: transform 0.3s ease;
}

.hover-scale:hover {
    transform: scale(1.05);
}

.text-glow {
    text-shadow: 0 0 8px #fbbf24;
}

/* Stats Cards */
.stat-item,
.stat-card {
    padding: 1.5rem;
    border-radius: 0.75rem;
    background: rgba(31, 41, 55, 0.6);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease-in-out;
}

.stat-item:hover,
.stat-card:hover {
    transform: translateY(-4px);
    background: rgba(31, 41, 55, 0.7);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

/* Badges */
.difficulty-easy {
    background: rgba(16, 185, 129, 0.9);
}

.difficulty-medium {
    background: rgba(245, 158, 11, 0.9);
}

.difficulty-hard {
    background: rgba(239, 68, 68, 0.9);
}

.rarity-legendary {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.rarity-epic {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.rarity-rare {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
}

/* Features */
.feature-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(59, 130, 246, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
    .stat-card {
        padding: 1rem;
    }

    .stat-icon-large {
        font-size: 2rem;
    }

    .stat-value-large {
        font-size: 1.8rem;
    }
}
</style>
