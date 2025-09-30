<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>{{ $t("page_title") }}</title>
        <meta head-key="description" name="description" :content="$t('page_description')" />
        <meta name="keywords" content="mini-games, jogos online, quiz de runeterra, hextech, league of legends" />
        <meta name="author" content="HextechPlay Team" />
    </Head>

    <div class="d-flex justify-content-center align-items-center py-5 min-vh-100 text-white">
        <div class="container">
            <h1 class="h3 fw-bold mb-4">{{ $t('title') }}</h1>

            <p class="text-warning small mb-4">
                <strong>{{ $t('effective_date') }}:</strong>
                {{ new Date().toISOString().split("T")[0] }}
            </p>

            <p>{{ $t('intro') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('info_we_collect_title') }}</h2>
            <p>{{ $t('info_we_collect_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('cookies_title') }}</h2>
            <p>
                {{ $t('cookies_text') }}
                <a href="https://www.google.com/settings/ads" target="_blank" class="link-warning">
                    {{ $t('google_ads_link') }}
                </a>.
            </p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('third_party_links_title') }}</h2>
            <p>{{ $t('third_party_links_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('consent_title') }}</h2>
            <p>{{ $t('consent_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('contact_title') }}</h2>
            <p>
                {{ $t('contact_text') }}
                <a href="mailto:contact@hextechplay.com" class="link-warning">
                    contact@hextechplay.com
                </a>
            </p>
        </div>
    </div>
</template>
