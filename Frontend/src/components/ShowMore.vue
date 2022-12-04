<template>
  <BaseButton variant="contained" mode="primary" @click="loadMore"
    >Show more</BaseButton
  >
</template>

<script setup>
import { ref } from "@vue/reactivity";
import BaseButton from "./UI/Buttons/BaseButton.vue";

const PRODUCTS_LIMIT = 4;
const emit = defineEmits(["onShowMoreClick"]);
const props = defineProps({
  count: {
    type: Number,
    required: true,
  },
  listLength: {
    type: Number,
    required: true,
  },
});

let itemsCountToShow = ref(props.count);

const loadMore = () => {
  if (props.count > props.listLength) return;

  itemsCountToShow.value += PRODUCTS_LIMIT;
  emit("onShowMoreClick", itemsCountToShow.value);
};
</script>

<style></style>
