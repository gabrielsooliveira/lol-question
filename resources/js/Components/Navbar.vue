<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref, computed } from 'vue';
import LocaleSwitcher from '@/js/Components/LocaleSwitcher.vue';

const isScrolled = ref(false);
const isMdUp = ref(window.innerWidth >= 992);

const handleScroll = () => {
  isScrolled.value = window.scrollY > 5;
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
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Marca -->
            <Link :href="route('home')" class="navbar-brand fw-bold text-light">HextechPlay</Link>

            <!-- Menu centralizado (visível no desktop) -->
            <ul class="navbar-nav mx-auto d-none d-lg-flex flex-row gap-3">
                <li class="nav-item">
                    <Link :href="route('home')" class="nav-link text-light">{{ $t('nav_home') }}</Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('menu')" class="nav-link text-light">{{ $t('nav_games') }}</Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('partners')" class="nav-link text-light">{{ $t('nav_partners') }}</Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('contact')" class="nav-link text-light">{{ $t('nav_contact') }}</Link>
                </li>
            </ul>

            <div class="d-none d-lg-flex">
                <LocaleSwitcher />
            </div>

            <!-- Botão mobile -->
            <button class="btn btn-primary d-lg-none border-0 text-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarPrincipal" aria-controls="navbarPrincipal" aria-expanded="false" aria-label="Toggle navigation">
                <font-awesome-icon icon="fas fa-bars" size="lg" />
            </button>

            <!-- Offcanvas (Menu Mobile) -->
            <div class="offcanvas offcanvas-start text-bg-dark d-lg-none" tabindex="-1" id="navbarPrincipal" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <Link :href="route('home')" class="navbar-brand fw-bold text-light">HextechPlay</Link>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <Link :href="route('home')" class="nav-link text-light">{{ $t('nav_home') }}</Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('menu')" class="nav-link text-light">{{ $t('nav_games') }}</Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('partners')" class="nav-link text-light">{{ $t('nav_partners') }}</Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('contact')" class="nav-link text-light">{{ $t('nav_contact') }}</Link>
                        </li>
                    </ul>
                    <LocaleSwitcher />
                </div>
            </div>
        </div>
    </nav>
</template>
