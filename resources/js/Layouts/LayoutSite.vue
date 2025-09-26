<script setup>
import Navbar from '@/js/Components/Navbar.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="bg-primary bg-gradient position-relative">
        <Navbar />

        <div class="min-vh-100">
            <slot></slot>
        </div>

        <footer class="position-absolute bottom-0 w-100 text-center py-2">
            <Link :href="route('privacy.policy')" class="text-white">
            {{ $t('privacy-policy') }}
            </Link>
        </footer>
    </div>
</template>
