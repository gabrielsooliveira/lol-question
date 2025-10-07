<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import ModalDialog from "@/js/Components/Modals/ModalDialog.vue";

const isModalVisible = ref(false);
const showGuide = ref(false);

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
        <title>{{ $t('page_title') }}</title>
        <meta head-key="description" name="description" :content="$t('page_description')" />
    </Head>

    <div class="min-vh-100 d-flex align-items-center justify-content-center">
        <div class="container text-center">
            <h1 class="fw-bold text-light">{{ $t('text_mode_game') }}</h1>

            <div class="row g-4 mt-3 justify-content-center">
                <div class="col-md-4">
                    <div class="card text-bg-light h-100 shadow-lg border-0">
                        <div class="card-body d-flex flex-column justify-content-between bg-gradient text-dark">
                            <div>
                                <h4 class="card-title fw-bold">Roleplay</h4>
                                <p class="card-text small">
                                    {{ $t('text_lorequestion_roleplay') }}
                                </p>
                            </div>
                            <button @click="openModal" class="btn btn-warning text-white mt-3 text-capitalize">
                                {{ $t('play') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-bg-light h-100 shadow-lg border-0">
                        <div class="card-body d-flex flex-column justify-content-between bg-gradient text-dark">
                            <div>
                                <h4 class="card-title fw-bold">{{ $t('competitive') }}</h4>
                                <p class="card-text small">
                                    {{ $t('text_lorequestion_competitive') }}
                                </p>
                            </div>
                            <button class="btn btn-warning mt-3" disabled>
                                {{ $t('coming_soon') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-sm btn-warning mt-5" @click="showGuide = true">
                <font-awesome-icon icon="fas fa-question"></font-awesome-icon>
            </button>
        </div>
    </div>

    <ModalDialog :isVisible="showGuide" @close="showGuide = false">
        <div class="text-primary p-3">
            <h3>{{ $t('guide.title') }}</h3>
            <ul>
                <li>{{ $t('guide.item1') }}</li>
                <li>{{ $t('guide.item2') }}</li>
                <li>{{ $t('guide.item3') }}</li>
                <li>{{ $t('guide.item4') }}</li>
                <li>{{ $t('guide.item5') }}</li>
                <li>{{ $t('guide.item6') }}</li>
            </ul>
        </div>
    </ModalDialog>

    <ModalDialog :isVisible="isModalVisible" @close="closeModal" :title=" $t('config_text')">
        <form @submit.prevent="saveSettings" class="container">
            <div class="mb-3 text-primary">
                <label class="form-label fw-semibold d-block text-capitalize">{{ $t('diffulty_phrase') }}</label>

                <div class="form-check form-check-inline">
                    <input class="form-check-input text-primary" type="radio" name="difficulty" id="difficultyEasy" value="easy" v-model="form.difficulty" />
                    <label class="form-check-label text-capitalize" for="difficultyEasy">{{ $t('diffulty.easy') }}</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input text-primary" type="radio" name="difficulty" id="difficultyMedium" value="medium" v-model="form.difficulty" />
                    <label class="form-check-label text-capitalize" for="difficultyMedium">{{ $t('diffulty.medium') }}</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input text-primary" type="radio" name="difficulty" id="difficultyHard" value="hard" v-model="form.difficulty" />
                    <label class="form-check-label text-capitalize" for="difficultyHard">{{ $t('diffulty.hard') }}</label>
                </div>
            </div>

            <div class="mb-3 text-primary">
                <label for="questionQuant" class="form-label fw-semibold">{{ $t('quantity_phrase') }}</label>
                <input type="range" class="form-range" min="1" max="10" id="questionQuant" v-model="form.questionQuant" name="questionQuant" required />
                <div>
                    <span>{{ form.questionQuant }} / 10</span>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-warning text-white flex-grow-1 fw-bold rounded-3 shadow text-capitalize">
                    {{ $t('button_start') }}
                </button>
            </div>
        </form>
    </ModalDialog>
</template>

