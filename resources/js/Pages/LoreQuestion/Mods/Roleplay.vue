<script setup>
import { ref, onMounted, watch } from 'vue'
import axios from 'axios'

const loading = ref(true)
const question = ref(null)
const selectedAnswer = ref(null)
const feedback = ref(null)
const isSubmitting = ref(false)
const gameFinished = ref(false)
const gameResults = ref(null)
const timer = ref(15) // Tempo em segundos para a resposta
const timerInterval = ref(null)

function startTimer() {
    clearInterval(timerInterval.value)
    timer.value = 15

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

function startNewGame() {
    gameFinished.value = false
    gameResults.value = null
    fetchQuestion()
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
    <div class="container my-5">
        <h1 class="mb-4">Jogo de Perguntas</h1>

        <div v-if="loading" class="text-secondary">Carregando pergunta...</div>

        <div v-else-if="gameFinished" class="card p-4">
            <h2 class="card-title text-center mb-4">Fim do Jogo!</h2>
            <div class="card-body">
                <p class="fs-4 text-center">Resultados:</p>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item">Total de perguntas: {{ gameResults.total_questions }}</li>
                    <li class="list-group-item">Acertos: {{ gameResults.correct_answers }}</li>
                    <li class="list-group-item">Erros: {{ gameResults.wrong_answers.length }}</li>
                </ul>

                <div v-if="gameResults.wrong_answers.length > 0">
                    <h5 class="mt-4">Perguntas que você errou:</h5>
                    <ul class="list-group">
                        <li v-for="(error, index) in gameResults.wrong_answers" :key="index" class="list-group-item list-group-item-danger">
                            <p class="mb-1"><strong>Pergunta:</strong> {{ error.question_text }}</p>
                            <p class="mb-1"><strong>Sua resposta:</strong> <span class="text-decoration-line-through">{{ error.user_answer }}</span></p>
                            <p class="mb-0"><strong>Resposta correta:</strong> {{ error.correct_answer }}</p>
                        </li>
                    </ul>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-primary" @click="startNewGame">Jogar Novamente</button>
                </div>
            </div>
        </div>

        <div v-else-if="!question" class="card p-4">
            <p class="text-danger">Nenhuma pergunta encontrada.</p>
            <button class="btn btn-primary mt-2" @click="fetchQuestion">Tentar Novamente</button>
        </div>

        <div v-else class="card p-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="card-text fw-semibold">{{ question.text }}</p>
                    <span class="badge bg-info text-dark fs-5">{{ timer }}s</span>
                </div>

                <div class="list-group mt-3">
                    <label
                        v-for="(option, index) in question.options"
                        :key="index"
                        class="list-group-item list-group-item-action d-flex align-items-center"
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
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                </div>

                <div v-if="feedback" class="mt-4 fw-bold text-center" :class="feedback.includes('correta') ? 'text-success' : 'text-danger'">
                    {{ feedback }}
                </div>
            </div>
        </div>
    </div>
</template>
