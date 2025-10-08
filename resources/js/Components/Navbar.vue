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
    <div class="container">
      <!-- Marca -->
      <Link :href="route('home')" class="navbar-brand fw-bold text-light">
        HextechPlay
      </Link>

      <!-- Botão mobile -->
      <button class="btn btn-primary d-lg-none border-0 text-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarPrincipal" aria-controls="navbarPrincipal" aria-expanded="false" aria-label="Toggle navigation">
        <font-awesome-icon icon="fas fa-bars" size="lg" />
      </button>

      <!-- Offcanvas (Menu Mobile) -->
      <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="navbarPrincipal" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header border-bottom">
          <Link :href="route('home')" class="navbar-brand fw-bold text-light">HextechPlay</Link>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <Link :href="route('home')" class="nav-link text-light">
                Home
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('menu')" class="nav-link text-light">
                Menu
              </Link>
            </li>
            <li class="nav-item">
              <Link :href="route('partnes')" class="nav-link text-light">
                Parceiros
              </Link>
            </li>
          </ul>
          <LocaleSwitcher />
        </div>
      </div>
    </div>
  </nav>
</template>
