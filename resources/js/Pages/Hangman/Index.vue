<template>
  <div class="min-vh-100 bg-dark text-white d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container-fluid text-center" style="max-width: 600px;">

      <!-- Título do Jogo -->
      <h1 class="mb-4 fw-bold text-primary">🎯 JOGO DA FORCA</h1>

      <!-- Palavra estilo TERMO -->
      <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
        <div
          v-for="(char, index) in displayWord.split(' ')"
          :key="`char-${index}`"
          class="letter-box"
          :class="getLetterBoxClass(char, index)"
        >
          {{ char !== '_' ? char : '' }}
        </div>
      </div>

      <!-- Status do Jogo -->
      <div class="mb-4">
        <div class="row text-center">
          <div class="col-6">
            <div class="bg-secondary rounded p-2">
              <small class="text-muted">TENTATIVAS</small>
              <div class="fs-4 fw-bold">{{ wrong }} / {{ maxAttempts }}</div>
            </div>
          </div>
          <div class="col-6">
            <div class="bg-secondary rounded p-2">
              <small class="text-muted">RESTANTES</small>
              <div class="fs-4 fw-bold">{{ maxAttempts - wrong }}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Mensagem de Status -->
      <div class="mb-4">
        <div v-if="won" class="alert alert-success fw-bold fs-5">
          🎉 PARABÉNS! VOCÊ GANHOU!
        </div>
        <div v-else-if="lost" class="alert alert-danger fw-bold fs-5">
          😢 VOCÊ PERDEU! A palavra era: <strong>{{ word }}</strong>
        </div>
        <div v-else class="alert alert-info">
          Digite uma letra ou tente adivinhar a palavra completa
        </div>
      </div>

      <!-- Input de Tentativa -->
      <div class="mb-4">
        <div class="input-group input-group-lg">
          <input
            type="text"
            v-model="userInput"
            class="form-control text-center text-uppercase fw-bold"
            :class="{ 'is-invalid': inputError }"
            placeholder="LETRA OU PALAVRA"
            :disabled="lost || won"
            @keyup.enter="makeGuess"
            @input="clearError"
            maxlength="20"
          />
          <button
            class="btn btn-primary px-4"
            @click="makeGuess"
            :disabled="lost || won || !userInput.trim()"
          >
            <span v-if="!loading">✅ TENTAR</span>
            <span v-else>⏳</span>
          </button>
        </div>
        <div v-if="inputError" class="text-danger mt-2">{{ inputError }}</div>
      </div>

      <!-- Letras Tentadas -->
      <div class="mb-4">
        <div class="row">
          <!-- Letras Corretas -->
          <div class="col-md-6 mb-3">
            <h6 class="text-success mb-2">✅ LETRAS CORRETAS</h6>
            <div class="bg-secondary rounded p-3 min-height-60">
              <div v-if="correctLetters.length > 0" class="d-flex flex-wrap gap-2">
                <span
                  v-for="letter in correctLetters"
                  :key="`correct-${letter}`"
                  class="badge bg-success fs-6 px-2 py-1"
                >
                  {{ letter }}
                </span>
              </div>
              <small v-else class="text-muted">Nenhuma ainda</small>
            </div>
          </div>

          <!-- Letras Erradas -->
          <div class="col-md-6 mb-3">
            <h6 class="text-danger mb-2">❌ LETRAS ERRADAS</h6>
            <div class="bg-secondary rounded p-3 min-height-60">
              <div v-if="wrongLetters.length > 0" class="d-flex flex-wrap gap-2">
                <span
                  v-for="letter in wrongLetters"
                  :key="`wrong-${letter}`"
                  class="badge bg-danger fs-6 px-2 py-1"
                >
                  {{ letter }}
                </span>
              </div>
              <small v-else class="text-muted">Nenhuma ainda</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Letras Não Tentadas que Estão na Palavra (em vermelho) -->
      <div v-if="missingLetters.length > 0 && (lost || won)" class="mb-4">
        <h6 class="text-warning mb-2">⚠️ LETRAS QUE VOCÊ PERDEU</h6>
        <div class="bg-secondary rounded p-3">
          <div class="d-flex flex-wrap gap-2 justify-content-center">
            <span
              v-for="letter in missingLetters"
              :key="`missing-${letter}`"
              class="badge bg-warning text-dark fs-6 px-2 py-1"
            >
              {{ letter }}
            </span>
          </div>
        </div>
      </div>

      <!-- Botão Novo Jogo -->
      <div class="mb-4">
        <button
          class="btn btn-outline-light btn-lg px-4"
          @click="resetGame"
          :disabled="loading"
        >
          🔄 NOVO JOGO
        </button>
      </div>

      <!-- Dicas -->
      <div class="mt-4">
        <small class="text-muted">
          💡 Dica: Digite uma letra para tentar ou a palavra completa para adivinhar de uma vez!
        </small>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

// Props recebidas do controller
const props = defineProps({
  displayWord: String,
  guessed: Array,
  wrongLetters: Array,
  wrong: Number,
  maxAttempts: Number,
  lost: Boolean,
  won: Boolean,
  word: String,
  missingLetters: Array,
})

// Estados reativos
const userInput = ref('')
const loading = ref(false)
const inputError = ref('')

// Computed properties
const correctLetters = computed(() => {
  return props.guessed.filter(letter =>
    props.word ? props.word.includes(letter) : false
  )
})

// Métodos
const getLetterBoxClass = (char, index) => {
  if (props.won) {
    return 'bg-success text-white border-success'
  }

  if (props.lost) {
    return 'bg-secondary text-white border-secondary'
  }

  if (char !== '_') {
    return 'bg-primary text-white border-primary'
  }

  return 'bg-dark border-light'
}

const makeGuess = async () => {
  if (!userInput.value.trim() || loading.value) return

  const input = userInput.value.trim().toUpperCase()

  // Validações
  if (input.length === 1 && !/^[A-Z]$/.test(input)) {
    inputError.value = 'Digite apenas letras!'
    return
  }

  if (input.length === 1 && props.guessed.includes(input)) {
    inputError.value = 'Você já tentou esta letra!'
    return
  }

  loading.value = true
  inputError.value = ''

  try {
    const payload = input.length === 1
      ? { letter: input }
      : { word: input }

    const response = await fetch(route('hangman.guess'), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify(payload)
    })

    const data = await response.json()

    if (data.error) {
      inputError.value = data.error
    } else {
      // Atualiza a página com os novos dados
      router.reload({ only: ['displayWord', 'guessed', 'wrongLetters', 'wrong', 'lost', 'won', 'word', 'missingLetters'] })
    }
  } catch (error) {
    inputError.value = 'Erro ao processar tentativa. Tente novamente.'
    console.error('Erro:', error)
  } finally {
    loading.value = false
    userInput.value = ''
  }
}

const resetGame = () => {
  if (loading.value) return

  loading.value = true
  router.post(route('hangman.reset'), {}, {
    onFinish: () => {
      loading.value = false
    }
  })
}

const clearError = () => {
  inputError.value = ''
}
</script>

<style scoped>
.letter-box {
  width: 50px;
  height: 50px;
  border: 2px solid;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  font-weight: bold;
  text-transform: uppercase;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.letter-box:hover {
  transform: scale(1.05);
}

.min-height-60 {
  min-height: 60px;
}

.input-group-lg .form-control {
  font-size: 1.25rem;
}

.badge {
  transition: transform 0.2s ease;
}

.badge:hover {
  transform: scale(1.1);
}

.alert {
  border-radius: 12px;
  border: none;
}

.btn {
  border-radius: 8px;
  transition: all 0.3s ease;
}

.btn:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.bg-secondary {
  background-color: #495057 !important;
}

@media (max-width: 576px) {
  .letter-box {
    width: 40px;
    height: 40px;
    font-size: 1.2rem;
  }

  .container-fluid {
    padding: 0 15px;
  }
}
</style>
