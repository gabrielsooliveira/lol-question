<script setup>
import { Head } from '@inertiajs/vue3';

// const props = defineProps({
//   partners: Array
// })

const partners = [
//   {
//     id: 1,
//     name: "StreamerNami",
//     platform: "Twitch",
//     link: "https://twitch.tv/streamernami",
//     avatar: "https://dummyimage.com/600x400/000/fff",
//     description: "Gameplay divertida e muito amor pelo LoL!",
//     featured: true
//   }
];

</script>

<template>
    <Head>
        <title>{{ $t('page_title') }}</title>
        <meta name="description" :content="$t('page_description')" />
        <meta name="keywords" :content="$t('page_keywords')" />
        <meta property="og:title" :content="$t('og_title')" />
        <meta property="og:description" :content="$t('og_description')" />
        <meta property="og:url" content="https://hextechplay.com" />
        <link rel="canonical" href="https://hextechplay.com" />
    </Head>

    <div class="container py-5 mt-5">
        <h1 class="text-center fw-bold mb-4 display-6 mt-5">{{ $t('page_title') }}</h1>
        <p class="text-center mb-5">{{ $t('page_description') }}</p>

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

