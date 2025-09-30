<script setup>
import { ref, computed, onMounted } from 'vue';

const checked = ref(false);
const accepted = ref(false);

onMounted(() => {
  // Verifica se já aceitou antes
  if (localStorage.getItem('accepted_terms') === 'true') {
    accepted.value = true;
    window.location.href = '/'; // redireciona direto
  }
});

const sections = computed(() => {
  const terms = Object.assign({}, $t('terms'));
  delete terms.title;
  delete terms.last_updated;
  return Object.values(terms);
});

function acceptTerms() {
  localStorage.setItem('accepted_terms', 'true');
  accepted.value = true;
  window.location.href = '/'; // redireciona para a página principal
}
</script>

<template>
  <div v-if="!accepted" class="terms-container p-4 bg-light rounded shadow-sm">
    <h2 class="mb-3">{{ $t('terms.title') }}</h2>
    <p class="text-muted mb-4">{{ $t('terms.last_updated') }}</p>

    <div class="terms-content mb-3" style="max-height: 300px; overflow-y: auto;">
      <section v-for="(section, key) in sections" :key="key" class="mb-3">
        <h5>{{ section.heading }}</h5>
        <p>{{ section.content }}</p>
      </section>
    </div>

    <div class="form-check mb-3">
      <input
        type="checkbox"
        class="form-check-input"
        id="acceptTerms"
        v-model="checked"
      >
      <label class="form-check-label" for="acceptTerms">
        I have read and accept the Terms of Use
      </label>
    </div>

    <button
      class="btn btn-primary"
      :disabled="!checked"
      @click="acceptTerms"
    >
      Continue
    </button>
  </div>
</template>

<style scoped>
.terms-container {
  max-width: 600px;
  margin: 50px auto;
}
</style>
