<template>
  <div class="select">
    <ul class="select__list">
      <li v-for="option in options" :key="option.id">
        <button
          type="button"
          :class="[
            'select__list-item-button',
            option.name === isActiveOption && 'active',
          ]"
          @click="select(option)"
        >
          <span class="select__list-item-text">{{ option.name }}</span>
        </button>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
const emit = defineEmits(["onSelectClick"]);
const props = defineProps({
  options: {
    type: Array,
    required: true,
  },
});

const isActiveOption = ref(null);

const select = (option) => {
  isActiveOption.value = option.name;
  emit("onSelectClick", option);
};
</script>

<style scoped>
.select {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}
.select__list {
  display: flex;
  gap: 20px;
  padding: 0;
  list-style: none;
}

.select__list-item-button {
  padding: 20px 30px;
  border: 2px solid #e2e2e2;
  border-radius: 8px;
  cursor: pointer;
  background-color: transparent;
  color: #222222;
}

.select__list-item-text {
  font-family: "Open Sans";
}

.select__list-item-button:hover:not(.active) {
  transition: border-color 0.3s linear;
  border-color: rgba(255, 168, 1, 0.4);
}

.active {
  border: 2px solid #ffa801;
}
</style>
