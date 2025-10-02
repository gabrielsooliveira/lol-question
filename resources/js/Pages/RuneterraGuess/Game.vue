<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';

const props = defineProps({
  displayWord: String,
  guessed: Array,
  wrongLetters: Array,
  wrong: Number,
  maxAttempts: Number,
  lost: Boolean,
  won: Boolean,
  word: String
})

const userInput = ref('')
const loading = ref(false)
const inputError = ref('')
const { t } = useI18n();

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

  if (input.length === 1 && !/^[A-Z]$/.test(input)) {
    inputError.value = t('input.error_invalid')
    return
  }

  if (input.length === 1 && props.guessed.includes(input)) {
    inputError.value = t('input.error_repeat')
    return
  }

  loading.value = true
  inputError.value = ''

  try {
    const payload = input.length === 1
      ? { letter: input }
      : { word: input }

    const response = await fetch(route('runeterraguess.game.guess'), {
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
      router.reload({ only: ['displayWord', 'guessed', 'wrongLetters', 'wrong', 'lost', 'won', 'word', 'missingLetters'] })
    }
  } catch (error) {
    inputError.value = t('input.error_generic')
    console.error('Erro:', error)
  } finally {
    loading.value = false
    userInput.value = ''
  }
}

const clearError = () => {
  inputError.value = ''
}
</script>

<template>
    <Head>
        <title>{{ t('page_title') }}</title>
        <meta head-key="description" name="description" :content="t('page_description')" />
    </Head>
  <div class="min-vh-100 d-flex align-items-center justify-content-center py-4">
    <div class="container w-50">
      <div class="card shadow-lg text-white rounded-4 border-0">
        <div class="card-body text-center p-4">
          <!-- Título -->
          <h2 class="fw-bold mb-4">
            <font-awesome-icon icon="fa-solid fa-gamepad" class="text-warning"/>
            {{ $t('title') }}
          </h2>

          <!-- Palavra -->
          <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
            <div
              v-for="(char, index) in displayWord.split(' ')"
              :key="`char-${index}`"
              class="border border-light rounded text-uppercase fw-bold d-flex align-items-center justify-content-center"
              :class="getLetterBoxClass(char, index)"
              style="width: 45px; height: 55px; font-size: 1.4rem; background: rgba(255,255,255,0.1);"
            >
              {{ char !== '_' ? char : '' }}
            </div>
          </div>

          <!-- Tentativas -->
          <div class="row g-3 mb-4">
            <div class="col-6">
              <div class="bg-dark rounded p-3 h-100">
                <small class="text-white d-block">{{ $t('attempts') }}</small>
                <div class="fs-4 fw-bold text-warning">{{ wrong }} / {{ maxAttempts }}</div>
              </div>
            </div>
            <div class="col-6">
              <div class="bg-dark rounded p-3 h-100">
                <small class="text-white d-block">{{ $t('attempts') }}</small>
                <div class="fs-4 fw-bold text-warning">{{ maxAttempts - wrong }}</div>
              </div>
            </div>
          </div>

          <!-- Mensagem de Status -->
          <div class="mb-4">
            <div v-if="won" class="alert alert-success fs-5 fw-bold rounded-3">
              {{ $t('status.won') }}
            </div>
            <div v-else-if="lost" class="alert alert-danger fs-5 fw-bold rounded-3">
              {{ $t('status.lost') }} <br />
              <small>{{ $t('status.lost_word') }}</small>
              <div class="fs-4 mt-2 text-uppercase">{{ word }}</div>
            </div>
            <div v-else class="alert alert-info rounded-3">
              {{ $t('status.playing') }}
            </div>
          </div>

          <!-- Input -->
          <div class="input-group input-group-lg mb-4">
            <input
              type="text"
              v-model="userInput"
              class="form-control text-center text-uppercase text-warning fw-bold"
              :class="{ 'is-invalid': inputError }"
              :placeholder="$t('input.placeholder')"
              :disabled="lost || won"
              @keyup.enter="makeGuess"
              @input="clearError"
              maxlength="20"
            />
            <button
              class="btn btn-warning px-4"
              @click="makeGuess"
              :disabled="lost || won || !userInput.trim()"
            >
              <span v-if="!loading">{{ $t('input.button_try') }}</span>
              <span v-else>{{ $t('input.button_loading') }}</span>
            </button>
          </div>
          <div v-if="inputError" class="text-danger small mb-3">{{ inputError }}</div>

          <!-- Letras Erradas -->
          <div class="mb-4 text-start">
            <h6 class="text-danger mb-2 fw-bold">{{ $t('wrong_letters.title') }}</h6>
            <div class="bg-dark rounded p-3 min-height-60">
              <div v-if="wrongLetters.length > 0" class="d-flex flex-wrap gap-2">
                <span
                  v-for="letter in wrongLetters"
                  :key="`wrong-${letter}`"
                  class="badge bg-danger fs-6 px-2 py-1"
                >
                  {{ letter }}
                </span>
              </div>
              <small v-else class="text-warning">{{ $t('wrong_letters.none') }}</small>
            </div>
          </div>

          <!-- Dica -->
          <div class="mt-3">
            <small class="text-warning">
              {{ $t('hint') }}
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
