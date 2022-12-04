<template>
  <button :class="['badge', quantity && 'activeIcon']">
    <BaseIcon>
      <slot></slot>
    </BaseIcon>

    <FadeTransition>
      <div class="badge__count" v-if="quantity">{{ quantity }}</div>
    </FadeTransition>
  </button>
</template>

<script setup>
import BaseIcon from "../BaseIcon.vue";
import FadeTransition from "../FadeTransition.vue";

const props = defineProps({
  quantity: {
    type: Number,
    required: false,
    default: null,
  },
});
</script>

<style scoped>
.badge {
  position: relative;
  display: flex;
  padding: 10px;
  border-radius: 50%;
  background-color: #f1f1f1;
  position: relative;
  border: none;
  cursor: pointer;
}

.activeIcon {
  background: transparent;
  fill: #5ec343;
  transition: all 0.3s ease-in;
}

.badge__count {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 10px;
  font-weight: 600;
  color: #222222;
  position: absolute;
  top: -7px;
  right: -7px;
  border: 2px solid white;
  background: #ffa801;
  border-radius: 50%;
  width: 18px;
  height: 18px;
}
</style>
