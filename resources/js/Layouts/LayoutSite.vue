<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="px-5 py-3">
        <Link :href="route('home')" class="btn btn-primary me-3">Home</Link>
        <Link :href="route('lorequestion.index')" class="btn btn-primary">Perguntas</Link>
    </div>

    <div class="container">
        <slot></slot>
    </div>
</template>
