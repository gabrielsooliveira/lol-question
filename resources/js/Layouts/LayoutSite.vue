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
    </div>
</template>
