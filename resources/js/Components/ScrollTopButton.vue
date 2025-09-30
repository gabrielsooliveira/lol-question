<script setup>
import { ref } from 'vue';

const show = ref(false);

const scrollToTop = () => window.scrollTo({ top: 0, behavior: 'smooth' });

window.addEventListener('scroll', () => {
  show.value = window.scrollY > 200;
});
</script>

<template>
  <button
    v-show="show"
    @click="scrollToTop"
    class="btn btn-warning position-fixed bottom-0 end-0 m-4 rounded-circle"
  >
    <font-awesome-icon icon="fas fa-arrow-up" />
  </button>
</template>
