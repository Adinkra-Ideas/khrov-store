<template>
  <FadeTransitionGroup class="products-list">
    <li
      class="products-list__item"
      v-for="product in productsToRender"
      :key="product.id"
    >
      <Card
        :image="product.image"
        :price="product.price"
        :title="product.title"
        :rating="product.rating"
        :id="product.id"
      />
    </li>
  </FadeTransitionGroup>

  <div
    class="products-list__show-more"
    v-if="itemsCountToRender < products.length"
  >
    <ShowMore
      :count="itemsCountToRender"
      :listLength="products.length"
      @onShowMoreClick="handleShowMore"
    />
  </div>
</template>

<script setup>
import Card from "./Card.vue";
import ShowMore from "./ShowMore.vue";
import FadeTransitionGroup from "./UI/FadeTransitionGroup.vue";
import { computed, ref, watch } from "@vue/runtime-core";

const PRODUCTS_LIMIT = 4;
let itemsCountToRender = ref(PRODUCTS_LIMIT);

const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
});

const handleShowMore = (count) => {
  itemsCountToRender.value = count;
};

const productsToRender = computed(() =>
  props.products.slice(0, itemsCountToRender.value)
);

watch(
  () => props.products,
  () => {
    itemsCountToRender.value = PRODUCTS_LIMIT;
  }
);
</script>

<style scoped>
.products-list {
  display: grid;
  gap: 25px;
  list-style: none;
  padding: 0;
}

.products-list__show-more {
  padding: 20px 0 0;
}

@media screen and (min-width: 768px) {
  .products-list {
    gap: 20px;
    grid-template-columns: repeat(2, 1fr);
    padding: 0;
  }
}

@media screen and (min-width: 1024px) {
  .products-list {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media screen and (min-width: 1280px) {
  .products-list {
    grid-template-columns: repeat(4, 1fr);
  }
}
</style>
