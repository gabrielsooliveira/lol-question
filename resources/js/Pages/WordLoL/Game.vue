<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from "vue";
import { Head, router } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import ModalDialog from "@/js/Components/Modals/ModalDialog.vue";

const props = defineProps({
  displayWord: String,
  guessed: Array,
  wrongLetters: Array,
  wrong: Number,
  maxAttempts: Number,
  lost: Boolean,
  won: Boolean,
  word: String,
  attempts: Number,
  timeRemaining: Object
});

const userInput = ref("");
const loading = ref(false);
const inputError = ref("");
const { t } = useI18n();
const isModalVisible = ref(false);
const showGuide = ref(false);

const getLetterBoxClass = (char, index) => {
  if (props.won) {
    return "bg-success text-white border-success";
  }

  if (props.lost) {
    return "bg-secondary text-white border-secondary";
  }

  if (char !== "_") {
    return "bg-primary text-white border-primary";
  }

  return "bg-dark border-light";
};

const makeGuess = async () => {
  if (!userInput.value.trim() || loading.value) return;

  const input = userInput.value.trim().toUpperCase();

  if (input.length === 1 && !/^[A-Z]$/.test(input)) {
    inputError.value = t("input.error_invalid");
    return;
  }

  if (input.length === 1 && props.guessed.includes(input)) {
    inputError.value = t("input.error_repeat");
    return;
  }

  loading.value = true;
  inputError.value = "";

  try {
    const payload = input.length === 1 ? { letter: input } : { word: input };

    const response = await fetch(route("wordlol.game.guess"), {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content"),
      },
      body: JSON.stringify(payload),
    });

    const data = await response.json();

    if (data.error) {
      inputError.value = data.error;
    } else {
      router.reload({
        only: [
          "displayWord",
          "guessed",
          "wrongLetters",
          "wrong",
          "lost",
          "attempts",
          "won",
          "word",
        ],
      });
    }
  } catch (error) {
    inputError.value = t("input.error_generic");
    console.error("Erro:", error);
  } finally {
    loading.value = false;
    userInput.value = "";
  }
};

const clearError = () => {
  inputError.value = "";
};

const liveTime = ref({ ...props.timeRemaining });
let timer;

onMounted(() => {
  timer = setInterval(() => {
    if (liveTime.value.seconds > 0) {
      liveTime.value.seconds--;
    } else if (liveTime.value.minutes > 0) {
      liveTime.value.minutes--;
      liveTime.value.seconds = 59;
    } else if (liveTime.value.hours > 0) {
      liveTime.value.hours--;
      liveTime.value.minutes = 59;
      liveTime.value.seconds = 59;
    }
  }, 1000);
});

onUnmounted(() => clearInterval(timer));

const formattedTime = computed(() => {
  const { hours, minutes, seconds } = liveTime.value;
  const pad = (n) => n.toString().padStart(2, "0");
  return `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
});

watch(
  () => [props.won, props.lost],
  ([won, lost]) => {
    if (won || lost) {
      isModalVisible.value = true;
    }
  },
  { immediate: true }
);

const closeModal = () => {
  isModalVisible.value = false;
};

const shareOnTwitter = () => {
  // Coleta as mensagens aleatórias de vitória/derrota
  const messagesWin = [
    t('result.win.item1'),
    t('result.win.item2'),
    t('result.win.item3'),
  ];

  const messagesLose = [
    t('result.lost.item1'),
    t('result.lost.item2'),
    t('result.lost.item3'),
  ];

  const message = props.won
    ? messagesWin[Math.floor(Math.random() * messagesWin.length)]
    : messagesLose[Math.floor(Math.random() * messagesLose.length)];

  // Textos com interpolação
  const attemptsInfo = props.attempts + t('attempts_info');
  const errorsInfo = t('error') + props.wrong + props.maxAttempts;
  const gameUrl = window.location.origin;

  let text = '';
  if (props.won) {
    text = `${message}\n${attemptsInfo}\n${errorsInfo}\n${t('invite_text')} ${gameUrl} #HextechPlay #WordLoL #LoL`;
  } else {
    text = `${message}\n${t('invite_text')} ${gameUrl} #HextechPlay #WordLoL #LoL`;
  }

  const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}`;
  window.open(twitterUrl, "_blank");
};
</script>

<template>
    <Head>
        <title>{{ $t('page_title') }}</title>
        <meta name="description" :content="$t('page_description')" />
        <meta name="keywords" :content="$t('page_keywords')" />
        <meta property="og:title" :content="$t('og_title')" />
        <meta property="og:description" :content="$t('og_description')" />
        <meta property="og:url" content="https://hextechplay.com/wordlol" />
        <link rel="canonical" href="https://hextechplay.com/wordlol" />
    </Head>

    <div class="min-vh-100 d-flex align-items-center justify-content-center py-4">
        <div class="container">
            <div class="card shadow-lg text-white rounded-4 border-0">
                <div class="card-body text-center p-4">
                    <h2 class="fw-bold mb-4"><font-awesome-icon icon="fa-solid fa-gamepad" class="text-warning"/> {{ $t("title") }}</h2>

                    <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                        <div
                        v-for="(char, index) in displayWord.split(' ')"
                        :key="`char-${index}`"
                        class="border border-light rounded text-uppercase fw-bold d-flex align-items-center justify-content-center fs-2"
                        :class="getLetterBoxClass(char, index)"
                        style="
                            width: 3rem;
                            height: 4rem;
                        "
                        >
                        {{ char !== "_" ? char : "" }}
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                        <div class="bg-dark rounded p-3 h-100">
                            <small class="text-white d-block">{{ $t("remaining") }}</small>

                            <div class="fs-4 fw-bold text-warning">
                            {{ wrong }} / {{ maxAttempts }}
                            </div>
                        </div>
                        </div>

                        <div class="col-6">
                        <div class="bg-dark rounded p-3 h-100">
                            <small class="text-white d-block">{{ $t("attempts") }}</small>
                            <div class="fs-4 fw-bold text-warning">
                            {{ attempts }}
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="input-group input-group-lg">
                        <input
                            type="text"
                            v-model="userInput"
                            class="form-control text-center text-uppercase text-warning fw-bold placeholder-text"
                            :class="{ 'is-invalid': inputError }"
                            :placeholder="$t('input.placeholder')"
                            :disabled="lost || won"
                            :maxlength="props.displayWord.split(' ').length"
                            @keyup.enter="makeGuess"
                            @input="clearError"
                        />

                        <button class="btn btn-warning px-4" @click="makeGuess" :disabled="lost || won || !userInput.trim()">
                            <span v-if="!loading">{{ $t("input.button_try") }}</span>
                            <span v-else>{{ $t("input.button_loading") }}</span>
                        </button>
                    </div>

                    <div v-if="inputError" class="text-danger small mb-3">
                        {{ inputError }}
                    </div>

                    <div class="mt-4 text-start">
                        <h6 class="text-danger mb-2 fw-bold">
                        {{ $t("wrong_letters.title") }}
                        </h6>

                        <div class="bg-dark rounded p-3 min-height-60">
                        <div
                            v-if="wrongLetters.length > 0"
                            class="d-flex flex-wrap gap-2"
                        >
                            <span
                            v-for="letter in wrongLetters"
                            :key="`wrong-${letter}`"
                            class="badge bg-danger fs-6 px-2 py-1"
                            >
                            {{ letter }}
                            </span>
                        </div>

                        <small v-else class="text-warning">{{
                            $t("wrong_letters.none")
                        }}</small>
                        </div>
                    </div>

                    <button class="btn btn-sm btn-warning mt-5" @click="showGuide = true">
                        <font-awesome-icon icon="fas fa-question"></font-awesome-icon>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <ModalDialog :isVisible="showGuide" @close="showGuide = false">
        <div class="text-primary">
            <h3>{{ $t("guide.title") }}</h3>
            <ul>
                <li>{{ $t('guide.item1') }}</li>
                <li>{{ $t('guide.item2') }}</li>
                <li>{{ $t('guide.item3') }}</li>
                <li>{{ $t('guide.item4') }}</li>
                <li>{{ $t('guide.item5') }}</li>
            </ul>
        </div>
    </ModalDialog>

    <ModalDialog :isVisible="isModalVisible" @close="closeModal" >
        <template #default>
            <div class="text-center py-1">
                <template v-if="props.won">
                    <h3 class="text-success">{{ $t('result.win.title') }}</h3>
                    <p class="text-dark">{{ $t('result.word') }} {{ props.word }}</p>
                </template>

                <template v-else-if="props.lost">
                    <h3 class="text-danger">{{ $t('result.lost.title') }}</h3>
                    <p class="text-dark">{{ $t('result.word') }} {{ props.word }}</p>
                </template>

                <hr class="my-4" />

                <div class="text-center">
                    <p class="mb-2 text-primary fw-bold">
                        {{ $t('next_question') }}
                    </p>
                    <h4 class="text-warning">{{ formattedTime }}</h4>
                </div>

                <hr class="my-4" />

                <div class="text-center">
                    <p class="text-primary fw-bold mb-2">{{ $t('share_result') }}</p>
                    <button @click="shareOnTwitter" class="btn btn-outline-primary fw-bold rounded-pill px-4">
                        <font-awesome-icon icon="fa-brands fa-x-twitter" class="me-2" />
                        {{ $t('share_button.twitter') }}
                    </button>
                </div>
            </div>
        </template>
    </ModalDialog>
</template>

<style>
.placeholder-text::placeholder {
  color: #3b82f6;
}
</style>
