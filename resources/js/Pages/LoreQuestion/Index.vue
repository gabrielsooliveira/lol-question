<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import ModalDialog from "@/js/Components/Modals/ModalDialog.vue";

const isModalVisible = ref(false);

const form = useForm({
    difficulty: "easy",
    questionQuant: 1,
});

const openModal = () => {
    isModalVisible.value = true;
};

const closeModal = () => {
    isModalVisible.value = false;
};

const saveSettings = () => {
    form.get(route("lorequestion.roleplay"), {
        onSuccess: () => {
            closeModal();
        },
    });
};
</script>

<template>
    <Head>
        <title>LoreQuestion</title>
        <meta head-key="description" name="description" content="LoreQuestion é um jogo da plataforma HextechPlay sobre perguntas envolvendo o universo de runeterra" />
    </Head>

    <div class="min-vh-100 d-flex align-items-center justify-content-center">
        <div class="container text-center">
            <h1 class="fw-bold mb-5 text-light">Escolha o modo de jogo</h1>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card h-100 shadow-lg border-0">
                        <div
                            class="card-body d-flex flex-column justify-content-between bg-gradient text-dark"
                        >
                            <div>
                                <h4 class="card-title fw-bold">Roleplay</h4>
                                <p class="card-text small">
                                    Teste seus conhecimentos sobre as histórias
                                    de runeterra.
                                </p>
                            </div>
                            <button
                                @click="openModal"
                                class="btn btn-primary text-white mt-3"
                            >
                                Jogar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-lg border-0">
                        <div
                            class="card-body d-flex flex-column justify-content-between bg-gradient text-dark"
                        >
                            <div>
                                <h4 class="card-title fw-bold">Competitivo</h4>
                                <p class="card-text small">
                                    Teste seus conhecimentos contra outros
                                    jogadores. (Em breve)
                                </p>
                            </div>
                            <button class="btn btn-dark mt-3" disabled>
                                Em breve
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ModalDialog :isVisible="isModalVisible" @close="closeModal" title="Configurações do Jogo">
        <form @submit.prevent="saveSettings">
            <div class="mb-3">
                <label class="form-label fw-semibold d-block">Nível de Dificuldade</label>

                <div class="form-check form-check-inline">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="difficulty"
                        id="difficultyEasy"
                        value="easy"
                        v-model="form.difficulty"
                    />
                    <label class="form-check-label" for="difficultyEasy">Fácil</label>
                </div>

                <div class="form-check form-check-inline">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="difficulty"
                        id="difficultyMedium"
                        value="medium"
                        v-model="form.difficulty"
                    />
                    <label class="form-check-label" for="difficultyMedium">Médio</label>
                </div>

                <div class="form-check form-check-inline">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="difficulty"
                        id="difficultyHard"
                        value="hard"
                        v-model="form.difficulty"
                    />
                    <label class="form-check-label" for="difficultyHard">Difícil</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="questionQuant" class="form-label fw-semibold">Quantidade de perguntas</label>
                <input type="range" class="form-range" min="1" max="10" id="questionQuant" v-model="form.questionQuant" name="questionQuant" required />
                <div>
                    <span>{{ form.questionQuant }} / 10</span>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary text-white flex-grow-1 fw-bold rounded-3 shadow">
                    Iniciar
                </button>
            </div>
        </form>
    </ModalDialog>
</template>
