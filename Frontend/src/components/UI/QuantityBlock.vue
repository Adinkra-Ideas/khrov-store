<template>
  <div class="quantity">
    <BaseIconButton
      @click="emit('decrement')"
      :isDisabled="isButtonDisabled"
      variant="outlined"
    >
      <MinusIcon />
    </BaseIconButton>

    <span class="quantity__count">{{ quantity }}</span>

    <BaseIconButton @click="emit('increment')" variant="outlined">
      <PlusIcon />
    </BaseIconButton>
  </div>
</template>

<script setup>
import PlusIcon from "../icons/PlusIcon.vue";
import MinusIcon from "../icons/MinusIcon.vue";
import BaseIconButton from "./Buttons/BaseIconButton.vue";
import { computed } from "@vue/runtime-core";

const emit = defineEmits(["increment", "decrement"]);
const props = defineProps({
  quantity: {
    type: Number,
    required: true,
    default: 1,
  },
});

const isButtonDisabled = computed(() => props.quantity <= 1);
</script>

<style scoped>
.quantity {
  display: flex;
  align-items: center;
  gap: 10px;
}

.quantity__count {
  width: 25px;
}
</style>
