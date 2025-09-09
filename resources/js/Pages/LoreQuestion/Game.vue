<script setup>
import axios from 'axios';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';

const loading = ref(true);
const question = ref(null);
const selectedAnswer = ref(null);
const feedback = ref(null);
const isSubmitting = ref(false);
const gameFinished = ref(false);
const gameResults = ref(null);
const timer = ref(10);
const timerInterval = ref(null);

function startTimer() {
    clearInterval(timerInterval.value)
    timer.value = 10

    timerInterval.value = setInterval(() => {
        if (timer.value > 0) {
            timer.value--
        } else {
            clearInterval(timerInterval.value)
            submitAnswerTimeout()
        }
    }, 1000)
}

function stopTimer() {
    clearInterval(timerInterval.value)
}

async function fetchQuestion() {
    stopTimer()
    loading.value = true
    feedback.value = null
    selectedAnswer.value = null

    try {
        const response = await axios.get(route('startGame'))
        if (response.data.finished) {
            gameFinished.value = true
        } else {
            question.value = response.data
            if (question.value) {
                startTimer()
            }
        }
    } catch (error) {
        console.error(error)
        question.value = null
    } finally {
        loading.value = false
    }
}

// A função `submitAnswer` agora é chamada automaticamente
async function submitAnswer() {
    stopTimer()
    isSubmitting.value = true
    await processSubmission(selectedAnswer.value)
}

async function submitAnswerTimeout() {
    stopTimer()
    isSubmitting.value = true
    await processSubmission('timeout')
}

async function processSubmission(answerValue) {
    try {
        const response = await axios.post(route('submitAnswer'), {
            question_id: question.value.id,
            answer: answerValue
        })

        if (answerValue === 'timeout') {
            feedback.value = 'Tempo esgotado! ⏳'
        } else {
            feedback.value = response.data.is_correct
                ? 'Resposta correta! 🎉'
                : 'Resposta incorreta! 😢'
        }

        if (response.data.finished) {
            gameFinished.value = true
            gameResults.value = response.data.results
        }

        setTimeout(() => {
            if (!gameFinished.value) {
                fetchQuestion()
            }
        }, 1500)

    } catch (error) {
        console.error(error)
    } finally {
        isSubmitting.value = false
    }
}

onMounted(() => {
    fetchQuestion()
})

watch(question, (newValue, oldValue) => {
    if (newValue && newValue !== oldValue) {
        startTimer();
    }
});
</script>

<template>
    <Head title="LoreQuestion - Play"></Head>
  <div class="d-flex justify-content-center align-items-center py-5 vh-100">
    <div class="container">
      <div class="row justify-content-center ">
        <div class="mt-5">
          <!-- Loader -->
          <div v-if="loading" class="text-center text-secondary animate-fade">
            <div class="spinner-border text-light mb-3" role="status"></div>
            <p>Carregando pergunta...</p>
          </div>

          <!-- Game Finished -->
          <div v-else-if="gameFinished" class="card shadow-lg p-4 animate-fade">
            <h2 class="card-title text-center mb-4">🎉 Fim do Jogo!</h2>
            <div class="card-body row">
              <div class="col-lg-4">
                <p class="fs-5 text-center mb-4">Resultados:</p>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item d-flex justify-content-between">
                    <span>Total de perguntas:</span>
                    <strong>{{ gameResults.total_questions }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between text-success">
                    <span>Acertos:</span>
                    <strong>{{ gameResults.correct_answers }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between text-danger">
                    <span>Erros:</span>
                    <strong>{{ gameResults.wrong_answers.length }}</strong>
                    </li>
                </ul>
              </div>

              <div v-if="gameResults.wrong_answers.length > 0" class="col-lg-8">
                <h5 class="mb-3">❌ Perguntas que você errou:</h5>
                <ul class="list-group">
                  <li
                    v-for="(error, index) in gameResults.wrong_answers"
                    :key="index"
                    class="list-group-item list-group-item-danger"
                  >
                    <p class="mb-1"><strong>Pergunta:</strong> {{ error.question_text }}</p>
                    <p class="mb-1"><strong>Sua resposta:</strong>
                      <span class="text-decoration-line-through">{{ error.user_answer }}</span>
                    </p>
                    <p class="mb-0"><strong>Resposta correta:</strong> {{ error.correct_answer }}</p>
                  </li>
                </ul>
              </div>

              <div class="text-center mt-4">
                <Link class="btn btn-primary btn-lg" :href="route('lorequestion.roleplay')">🔄 Jogar Novamente</Link>
              </div>
            </div>
          </div>

          <!-- Nenhuma pergunta -->
          <div v-else-if="!question" class="card shadow-lg p-4 animate-fade text-center">
            <p class="text-danger mb-3">Nenhuma pergunta encontrada.</p>
            <button class="btn btn-primary" @click="fetchQuestion">Tentar Novamente</button>
          </div>

          <!-- Pergunta -->
          <div v-else class="card shadow-lg p-4 animate-fade">
            <div class="card-body">
                <span class="badge bg-dark text-light">{{ question.region }}</span>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="card-text fw-semibold fs-5">{{ question.text }}</p>
                <span class="badge bg-primary text-light fs-6 px-3 py-2 shadow-sm">{{ timer }}s</span>
              </div>

              <div class="list-group mt-3">
                <label
                  v-for="(option, index) in question.options"
                  :key="index"
                  class="list-group-item list-group-item-action d-flex align-items-center rounded-3 mb-2 option-hover"
                >
                  <input
                    class="form-check-input me-2"
                    type="radio"
                    :value="option"
                    v-model="selectedAnswer"
                    :disabled="isSubmitting"
                    @change="submitAnswer"
                  />
                  <span>{{ option }}</span>
                </label>
              </div>

              <div v-if="isSubmitting" class="mt-4 text-center">
                <div class="spinner-border text-primary" role="status"></div>
              </div>

              <div
                v-if="feedback"
                class="mt-4 fw-bold text-center animate-fade"
                :class="feedback.includes('correta') ? 'text-success' : 'text-danger'"
              >
                {{ feedback }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Animações e hover leve */
.option-hover:hover {
  background-color: rgba(255,255,255,0.1);
  cursor: pointer;
  transform: scale(1.02);
  transition: all 0.2s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>


