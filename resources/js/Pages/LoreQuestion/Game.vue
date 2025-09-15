<script setup>
import axios from 'axios';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const loading = ref(true);
const questions = ref([]);
const currentQuestionIndex = ref(0);
const selectedAnswer = ref(null);
const isSubmitting = ref(false);
const gameFinished = ref(false);
const gameResults = ref(null);
const timer = ref(15);
const timerInterval = ref(null);
const userAnswers = ref([]);

const currentQuestion = ref(null);

function startTimer() {
    clearInterval(timerInterval.value);
    timer.value = 15;

    timerInterval.value = setInterval(() => {
        if (timer.value > 0) {
            timer.value--;
        } else {
            clearInterval(timerInterval.value);
            submitAnswer('timeout');
        }
    }, 1000);
}

function stopTimer() {
    clearInterval(timerInterval.value);
}

async function fetchQuestions() {
    loading.value = true;
    try {
        const response = await axios.get(route('startGame'));
        questions.value = response.data.questions;
        if (questions.value.length > 0) {
            currentQuestion.value = questions.value[currentQuestionIndex.value];
            startTimer();
        }
    } catch (error) {
        console.error(error);
    } finally {
        loading.value = false;
    }
}

function submitAnswer(answerValue) {
    stopTimer();
    isSubmitting.value = true;

    userAnswers.value.push({
        question_id: currentQuestion.value.id,
        answer: answerValue
    });

    if (currentQuestionIndex.value + 1 >= questions.value.length) {
        setTimeout(async () => {
            await finishGame();
        }, 1500);
    } else {
        setTimeout(() => {
            currentQuestionIndex.value++;
            currentQuestion.value = questions.value[currentQuestionIndex.value];
            selectedAnswer.value = null;
            isSubmitting.value = false;
            startTimer();
        }, 1500);
    }
}

async function finishGame() {
    isSubmitting.value = true;
    try {
        const response = await axios.post(route('finishGame'), {
            respostas: userAnswers.value
        });
        gameResults.value = response.data;
        gameFinished.value = true;
    } catch (error) {
        console.error(error);
    } finally {
        isSubmitting.value = false;
    }
}

onMounted(() => {
    fetchQuestions();
});
</script>

<template>
    <Head title="LoreQuestion - Play"></Head>
    <div class="d-flex justify-content-center align-items-center py-5 min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="mt-5">
                    <div v-if="loading" class="text-center text-secondary animate-fade">
                        <div class="spinner-border text-light mb-3" role="status"></div>
                        <p>Carregando perguntas...</p>
                    </div>

                    <div v-else-if="gameFinished" class="card shadow-lg p-4 animate-fade mt-5">
                        <h2 class="card-title text-center mb-4">Fim do Jogo!</h2>
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
                                <h5 class="mb-3">Perguntas que você errou:</h5>
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
                                <Link class="btn btn-primary btn-lg ms-2" :href="route('lorequestion.roleplay')">Jogar Novamente</Link>
                                <Link class="btn btn-dark btn-lg" :href="route('lorequestion.index')">Voltar para o menu</Link>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="!currentQuestion" class="card shadow-lg p-4 animate-fade text-center">
                        <p class="text-danger mb-3">Nenhuma pergunta encontrada.</p>
                        <button class="btn btn-primary" @click="fetchQuestions">Tentar Novamente</button>
                    </div>

                    <div v-else class="card shadow-lg p-4 animate-fade">
                        <div class="card-body">
                            <span class="badge bg-dark text-light">{{ currentQuestion.region }}</span>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="card-text fw-semibold fs-5">{{ currentQuestion.text }}</p>
                                <span class="badge bg-primary text-light fs-6 px-3 py-2 shadow-sm">{{ timer }}s</span>
                            </div>

                            <div class="list-group mt-3">
                                <label
                                    v-for="(option, index) in currentQuestion.options"
                                    :key="index"
                                    class="list-group-item list-group-item-action d-flex align-items-center rounded-3 mb-2 option-hover"
                                >
                                    <input
                                        class="form-check-input me-2"
                                        type="radio"
                                        :value="option"
                                        v-model="selectedAnswer"
                                        :disabled="isSubmitting"
                                        @change="submitAnswer(option)"
                                    />
                                    <span>{{ option }}</span>
                                </label>
                            </div>

                            <div v-if="isSubmitting" class="mt-4 text-center">
                                <div class="spinner-border text-primary" role="status"></div>
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
    background-color: rgba(255, 255, 255, 0.1);
    cursor: pointer;
    transform: scale(1.02);
    transition: all 0.2s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
