<script setup>
import { Head } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';
</script>

<template>
    <Head :title="$t('loading_head')"></Head>
    <div class="d-flex vh-100 align-items-center justify-content-center bg-dark text-light">
        <div class="text-center">
            <div class="spinner-border text-primary mb-4" role="status"></div>
            <h3 class="fw-bold mb-2 text-warning">{{ $t('loading_title') }}</h3>
            <p class="opacity-75">{{ $t('loading_text') }}</p>
        </div>
    </div>
</template>
