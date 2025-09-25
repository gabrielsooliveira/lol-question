<script setup>
import { ref } from "vue";
import axios from "axios";

const props = defineProps({
  displayWord: String,
  guessed: Array,
  wrong: Number,
  maxAttempts: Number,
});

const displayWord = ref(props.displayWord);
const guessed = ref(props.guessed);
const wrong = ref(props.wrong);
const maxAttempts = ref(props.maxAttempts);

const guessLetter = async (letter) => {
  try {
    const { data } = await axios.post(route("hangman.guess"), { letter });
    displayWord.value = data.displayWord;
    guessed.value = data.guessed;
    wrong.value = data.wrong;
  } catch (e) {
    console.error(e);
  }
};

const restartGame = async () => {
  try {
    const { data } = await axios.post(route("hangman.restart"));
    displayWord.value = data.displayWord;
    guessed.value = data.guessed;
    wrong.value = data.wrong;
    maxAttempts.value = data.maxAttempts;
  } catch (e) {
    console.error(e);
  }
};
</script>

<template>
  <div class="d-flex flex-column align-items-center p-4">
    <h1 class="h3 fw-bold mb-3 text-white">Jogo da Forca</h1>

    <!-- Palavra -->
    <div class="h2 mb-3 text-white">
      {{ displayWord }}
    </div>

    <!-- Status -->
    <p class="mb-3 text-white">
      Tentativas: {{ wrong }} / {{ maxAttempts }}
    </p>

    <!-- Alfabeto -->
    <div class="row row-cols-7 g-2">
      <div
        v-for="letter in 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('')"
        :key="letter"
        class="col"
      >
        <button
          type="button"
          class="btn btn-outline-primary w-100 text-white"
          :disabled="guessed.includes(letter) || wrong >= maxAttempts"
          @click="guessLetter(letter)"
        >
          {{ letter }}
        </button>
      </div>
    </div>

    <!-- Fim de jogo -->
    <div v-if="wrong >= maxAttempts" class="mt-4 text-danger fw-bold">
      Você perdeu!
    </div>
    <div
      v-else-if="!displayWord.includes('_')"
      class="mt-4 text-success fw-bold"
    >
      🎉 Você ganhou!
    </div>

    <!-- Botão Reiniciar -->
    <button
      class="btn btn-warning mt-4"
      @click="restartGame"
    >
      🔄 Reiniciar Jogo
    </button>
  </div>
</template>
