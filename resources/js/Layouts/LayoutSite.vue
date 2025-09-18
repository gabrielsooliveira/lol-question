<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import LocaleSwitcher from '@/js/Components/LocaleSwitcher.vue';

const isScrolled = ref(false);

onMounted(() => {
  window.addEventListener('scroll', () => {
    isScrolled.value = window.scrollY > 50;
  });
});
</script>

<template>
    <div class="bg-primary bg-gradient">
        <nav :class="['navbar navbar-expand-lg fixed-top navbar-dark transition-navbar px-4', isScrolled ? 'bg-primary shadow-sm' : 'bg-transparent']">
            <div class="container">
                <Link :href="route('home')" class="navbar-brand fw-bold">HextechPlay</Link>

                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <Link :href="route('home')" class="nav-link link-light">Home</Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('menu')" class="nav-link link-light">Menu</Link>
                    </li>
                </ul>
            </div>
            <LocaleSwitcher />
        </nav>
        <div class="min-vh-100">
            <slot></slot>
        </div>
    </div>
</template>
