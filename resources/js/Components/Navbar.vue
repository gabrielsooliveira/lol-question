<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref, computed } from 'vue';
import LocaleSwitcher from '@/js/Components/LocaleSwitcher.vue';

const isScrolled = ref(false);
const isMdUp = ref(window.innerWidth >= 992);

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50;
};

const handleResize = () => {
  isMdUp.value = window.innerWidth >= 992;
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
  window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
  window.removeEventListener('resize', handleResize);
});

const navbarClass = computed(() => {
  const baseClasses = 'navbar navbar-expand-lg fixed-top navbar-dark transition-navbar px-2';
  const bgClass = (!isMdUp.value || isScrolled.value) ? 'bg-primary shadow-glow' : 'bg-transparent';

  return `${baseClasses} ${bgClass}`;
});
</script>

<template>
    <nav :class="navbarClass" aria-label="Navbar principal">
        <div class="container-fluid">
            <Link :href="route('home')" class="navbar-brand fw-bold">HextechPlay</Link>
            <button
                class="btn btn-primary d-lg-none border-0 text-light"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarPrincipal"
                aria-controls="navbarPrincipal"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <font-awesome-icon :icon="['fas', 'bars']" size="lg"/>
            </button>

            <div class="collapse navbar-collapse" id="navbarPrincipal">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <Link :href="route('home')" class="nav-link link-light">Home</Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('menu')" class="nav-link link-light">Menu</Link>
                    </li>
                </ul>
                <LocaleSwitcher></LocaleSwitcher>
            </div>
        </div>
    </nav>
</template>
