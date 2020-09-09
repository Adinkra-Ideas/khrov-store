<template>
  <svg xmlns="http://www.w3.org/2000/svg" :width="width" :height="height" viewBox="4 3 40 40" role="presentation">
    <g :fill="iconColor">
      <slot></slot>
    </g>
  </svg>
</template>

<script setup>
const props = defineProps({
  width: {
    type: [Number, String],
    default: 16,
  },
  height: {
    type: [Number, String],
    default: 16,
  },
  iconColor: {
    type: String,
    default: '#e2e2e2',
  },
});
</script>

<style scoped>
svg {
  display: inline-block;
  vertical-align: baseline;
  margin-bottom: -2px;
}

g {
  fill: inherit;
}
</style>
