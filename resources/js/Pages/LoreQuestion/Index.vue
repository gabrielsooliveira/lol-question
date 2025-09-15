<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue';
import ModalDialog from '@/js/Components/Modals/ModalDialog.vue';

const isModalVisible = ref(false);

const form = useForm({
    difficulty: 'easy',
});

const openModal = () => {
    isModalVisible.value = true;
};

const closeModal = () => {
    isModalVisible.value = false;
};

const saveSettings = () => {
    form.get(route('lorequestion.roleplay'), {
        onSuccess: () => {
            closeModal();
        },
    });
};
</script>

<template>
    <Head title="LoreQuestion"></Head>
    <div class="min-vh-100 d-flex align-items-center justify-content-center">
        <div class="container text-center">
        <h1 class="fw-bold mb-5 text-light">Escolha o modo de jogo</h1>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card h-100 shadow-lg border-0">
                    <div class="card-body d-flex flex-column justify-content-between bg-gradient text-dark">
                        <div>
                            <h4 class="card-title fw-bold">Roleplay</h4>
                            <p class="card-text small">
                            Teste seus conhecimentos sobre as histórias de runeterra.
                            </p>
                        </div>
                        <button @click="openModal" class="btn btn-danger text-white mt-3">Jogar</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-lg border-0">
                    <div class="card-body d-flex flex-column justify-content-between bg-gradient text-dark">
                        <div>
                            <h4 class="card-title fw-bold">Competitivo</h4>
                            <p class="card-text small">
                            Teste seus conhecimentos contra outros jogadores. (Em breve)
                            </p>
                        </div>
                        <button class="btn btn-dark mt-3" disabled>Em breve</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <ModalDialog :isVisible="isModalVisible" @close="closeModal" title="Configurações do Jogo" size="sm">
        <form @submit.prevent="saveSettings">
            <div class="mb-3">
                <label for="difficulty" class="form-label">Nível de Dificuldade</label>
                <select class="form-select" id="difficulty" v-model="form.difficulty">
                    <option value="easy">Fácil</option>
                    <option value="medium">Médio</option>
                    <option value="hard">Difícil</option>
                </select>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-dark text-white flex-grow-1 fw-bold rounded-3 shadow">Iniciar</button>
            </div>
        </form>
    </ModalDialog>
</template>
