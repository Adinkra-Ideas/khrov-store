<template>
  <button
    :class="['button', variant, isActive && 'active']"
    type="button"
    :disabled="isDisabled"
  >
    <div
      :class="[text && 'container']"
      :style="{ display: !text && 'contents' }"
    >
      <span class="text" v-if="text">{{ text }}</span>
      <BaseIcon>
        <slot></slot>
      </BaseIcon>
    </div>
  </button>
</template>

<script setup>
import BaseIcon from "../BaseIcon.vue";

const props = defineProps({
  isDisabled: {
    type: Boolean,
    required: false,
    default: false,
  },
  iconColor: {
    type: String,
    required: false,
  },
  iconHoverColor: {
    type: String,
    required: false,
  },
  variant: {
    type: String,
    required: false,
  },
  isActive: {
    type: Boolean,
    required: false,
    default: false,
  },
  iconActiveColor: {
    type: String,
    required: false,
  },
  opacity: {
    type: String,
    required: false,
  },
  text: {
    type: String,
    required: false,
  },
});
</script>

<style scoped>
.button {
  font-family: "Open Sans";
  display: block;
  padding: 0;
  background-color: transparent;
  cursor: pointer;
  fill: v-bind(iconColor);
}

.contained {
  color: #747474;
  border: none;
}

.contained:hover {
  color: #ffa801;
  opacity: v-bind(opacity);
  fill: v-bind(iconHoverColor);
  transition: all 0.2s ease-in;
}

.contained:focus:hover.active {
  opacity: 1;
  fill: v-bind(iconActiveColor);
  transition: all 0.2s ease-in;
}

.outlined {
  border: 1px solid #e2e2e2;
  border-radius: 6px;
  padding: 5px 8px;
}

.outlined:hover {
  transition: background-color 0.15s linear;
  background-color: #e2e2e2;
}

.outlined:disabled {
  fill: lightgray;
  cursor: default;
}

.outlined:disabled:hover {
  background-color: transparent;
}

.active {
  fill: v-bind(iconActiveColor);
}

.container {
  display: flex;
  gap: 10px;
  align-items: center;
  color: inherit;
}

.text {
  font-weight: 600;
  font-size: 15px;
  line-height: 20px;
}
</style>
