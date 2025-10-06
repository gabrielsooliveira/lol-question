<script setup>
import { ref, onMounted, onBeforeUnmount, watch, nextTick, computed } from 'vue';
import { Modal } from 'bootstrap';

const props = defineProps({
  title: String,
  size: { type: String, default: 'md' },
  isVisible: { type: Boolean, default: false },
});

const emit = defineEmits(['close']);
const modalRef = ref(null);
let modalInstance = null;

const closeModal = () => {
  if (modalInstance) modalInstance.hide();
  emit('close');
};

onMounted(() => {
  if (modalRef.value) {
    modalInstance = new Modal(modalRef.value, {
      backdrop: 'static',
      keyboard: false,
    });

    if (props.isVisible) {
      nextTick(() => modalInstance.show());
    }

    // Fechar quando o modal Bootstrap emitir o evento "hidden.bs.modal"
    modalRef.value.addEventListener('hidden.bs.modal', () => emit('close'));
  }
});

watch(
  () => props.isVisible,
  (val) => {
    if (!modalInstance) return;
    if (val) nextTick(() => modalInstance.show());
    else modalInstance.hide();
  }
);

onBeforeUnmount(() => {
  if (modalInstance) modalInstance.dispose();
});

const sizeClass = computed(() => (props.size ? `modal-${props.size}` : ''));
</script>

<template>
  <div ref="modalRef" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" :class="sizeClass">
      <div class="modal-content rounded-4 bg-light shadow">
        <div class="d-flex justify-content-between align-items-center px-3 pt-3">
          <h4 class="modal-title text-primary fw-bold">{{ title }}</h4>
          <button
            type="button"
            class="btn btn-outline-light btn-sm border-0"
            @click="closeModal"
          >
            <font-awesome-icon icon="fas fa-times" class="text-warning" />
          </button>
        </div>
        <div class="modal-body">
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
</template>
