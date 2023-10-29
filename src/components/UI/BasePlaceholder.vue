<template>
  <BaseHeading variant="h2" class="placeholder">
    <slot />
  </BaseHeading>
</template>

<script setup>
import BaseHeading from "./BaseHeading.vue";

</script>

<style scoped>
.placeholder {
  color: lightgray;
}
</style>
