<template>
  <button
    :class="['button', variant, mode]"
    :type="type"
    :disabled="isDisabled"
  >
    <slot> </slot>
  </button>
</template>

<script setup>
const props = defineProps({
  isDisabled: {
    tyle: Boolean,
    required: false,
    default: false,
  },
  variant: {
    type: String,
    required: false,
  },
  type: {
    type: String,
    required: false,
    default: "button",
  },
  mode: {
    type: String,
    required: false,
  },
});
</script>

<style scoped>
.button {
  font-family: "Open Sans";
  align-self: stretch;
  background: transparent;
  border: 1px solid #e2e2e2;
  color: #222222;
  border-radius: 6px;
  cursor: pointer;
  padding: 10px 15px;
}

.outlined:hover {
  transition: background-color 0.3s linear;
  background-color: #e2e2e2;
}

.contained.success {
  border: 1px solid transparent;
  background-color: #5ec343;
  font-weight: 600;
  color: #fff;
}

.contained.primary {
  border: 1px solid transparent;
  background-color: #ffa801;
  color: #fff;
}

.contained:hover {
  transition: opacity 0.3s linear;
  opacity: 0.75;
}

.button:disabled {
  fill: lightgray;
  cursor: default;
}

@media screen and (min-width: 768px) {
  .button {
    padding: 10px 20px;
  }
}
</style>
