<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const isScrolled = ref(false);

onMounted(() => {
  window.addEventListener('scroll', () => {
    isScrolled.value = window.scrollY > 50;
  });
});
</script>

<template>
    <div class="bg-primary bg-gradient">
        <nav :class="['navbar navbar-expand-lg fixed-top navbar-dark transition-navbar', isScrolled ? 'bg-primary shadow-sm' : 'bg-transparent']">
            <div class="container">
                <Link :href="route('home')" class="navbar-brand fw-bold">HextechPlay</Link>

                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <Link :href="route('home')" class="nav-link link-light">Home</Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('hub')" class="nav-link link-light">Hub</Link>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="min-vh-100">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>
/* Transição suave da navbar */
.transition-navbar {
  transition: background-color 0.4s ease, box-shadow 0.4s ease;
}
</style>
