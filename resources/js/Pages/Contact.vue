<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>{{ $t('home.page_title') }}</title>
        <meta name="description" :content="$t('home.page_description')" />
        <meta name="keywords" :content="$t('home.page_keywords')" />
        <meta property="og:title" :content="$t('home.og_title')" />
        <meta property="og:description" :content="$t('home.og_description')" />
        <meta property="og:url" content="https://hextechplay.com/contact" />
        <link rel="canonical" href="https://hextechplay.com/contact" />
    </Head>

    <section class="py-5 mt-5">
        <div class="mt-5 text-center">
            <h1 class="text-warning display-3 fw-bold mb-3 fade-in">Central de Ajuda</h1>
        </div>
    </section>
</template>
