<script setup>
import Navbar from '@/js/Components/Navbar.vue';
import LoadingScreen from '@/js/Components/LoadingScreen.vue';
import ScrollTopButton from '@/js/Components/ScrollTopButton.vue';
import ParticlesBackground from '@/js/Components/ParticlesBackground.vue';
import PopUpTerms from '@/js/Components/PopUpTerms.vue';
import Footer from '@/js/Components/Footer.vue';
import { ref, onMounted } from 'vue';

const isLoading = ref(true);

onMounted(() => {
  setTimeout(() => isLoading.value = false, 1400);
});
</script>

<template>
  <LoadingScreen v-if="isLoading" />

  <div v-else class="position-relative overflow-hidden bg-dark text-light">
    <ParticlesBackground />
    <Navbar />
    <main class="position-relative min-vh-100">
      <slot></slot>
    </main>
    <PopUpTerms />
    <Footer />
    <ScrollTopButton />
  </div>
</template>
