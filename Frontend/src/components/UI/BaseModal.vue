<template>
  <FadeTransition>
    <div
      @click="closeModal(type)"
      class="modal__backdrop"
      v-if="isModalOpen"
    ></div>
  </FadeTransition>

  <FadeTransition>
    <dialog class="modal" open v-if="isModalOpen">
      <h2>
        {{ title }}
      </h2>
      <section>
        <slot></slot>
      </section>

      <section class="modal__actions">
        <BaseButton @click="closeModal(type)" variant="outlined">{{
          closeButtonText
        }}</BaseButton>
        <slot name="actions"></slot>
      </section>
    </dialog>
  </FadeTransition>
</template>

<script setup>
import { useCommonStore } from "@/store/useCommonStore";
import BaseButton from "./Buttons/BaseButton.vue";
import FadeTransition from "./FadeTransition.vue";

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  closeButtonText: {
    type: String,
    required: false,
    default: "Continue shopping",
  },
  isModalOpen: {
    type: Boolean,
    reqquired: true,
    default: false,
  },
  type: {
    type: String,
    required: true,
  },
});

const commonStore = useCommonStore();

const closeModal = (modal) => {
  commonStore.closeModal(modal);
};
</script>

<style scoped>
.modal__backdrop {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100%;
  background: rgba(0, 0, 0, 0.8);
  box-shadow: none;
  overflow: hidden;
  z-index: 2;
}

.modal {
  display: flex;
  flex-direction: column;
  gap: 30px;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  padding: 40px 20px;
  border-radius: 16px;
  z-index: 3;
  border: 1px solid black;
  box-sizing: border-box;
  padding: 20px;
  max-height: calc(100vh - 20px);
  overflow-y: auto;
}

.modal__actions {
  display: flex;
  gap: 20px;
  justify-content: flex-end;
}

@media screen and (min-width: 768px) {
  .modal {
    width: 700px;
  }
}

@media screen and (min-width: 1024px) {
  .modal {
    width: 800px;
  }
}
</style>
