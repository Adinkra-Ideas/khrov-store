<template>
  <transition-group name="list" tag="ul">
    <slot></slot>
  </transition-group>
</template>

<script setup>

const props = defineProps({
  duration: {
    type: Number,
    required: false,
    default: 0.3,
  },
});

</script>

<style>
.list-enter-from {
  opacity: 0;
}

.list-enter-active {
  transition: opacity v-bind(duration + 's') ease;
}

.list-enter-to {
  opacity: 1;
}
</style>
