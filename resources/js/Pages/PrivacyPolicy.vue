<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head>
        <title>{{ $t("page_title") }}</title>
        <meta head-key="description" name="description" :content="$t('page_description')" />
    </Head>

    <div class="d-flex justify-content-center align-items-center py-5 min-vh-100 text-white">
        <div class="container mt-5 py-3">
            <h1 class="h3 fw-bold mb-4">{{ $t('title') }}</h1>

            <p class="text-warning small mb-4">
                <strong>{{ $t('effective_date') }}:</strong>
                28/10/2025
            </p>

            <p>{{ $t('intro') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('definitions_title') }}</h2>
            <p>{{ $t('definitions_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('info_we_collect_title') }}</h2>
            <p>{{ $t('info_we_collect_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('cookies_title') }}</h2>
            <p>
                {{ $t('cookies_text') }}
                <a href="https://www.google.com/settings/ads" target="_blank" class="link-warning">
                    {{ $t('google_ads_link') }}
                </a>.
            </p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('purposes_title') }}</h2>
            <p>{{ $t('purposes_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('sharing_title') }}</h2>
            <p>{{ $t('sharing_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('third_party_links_title') }}</h2>
            <p>{{ $t('third_party_links_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('rights_title') }}</h2>
            <p>{{ $t('rights_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('security_title') }}</h2>
            <p>{{ $t('security_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('changes_title') }}</h2>
            <p>{{ $t('changes_text') }}</p>

            <h2 class="h5 fw-semibold mt-4">{{ $t('contact_title') }}</h2>
            <p>
                {{ $t('contact_text') }}
                <a href="mailto:hextechplaycontact@gmail.com" class="link-warning">
                    hextechplaycontact@gmail.com
                </a>
            </p>
        </div>
    </div>
</template>
