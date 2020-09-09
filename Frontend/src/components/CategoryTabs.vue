<template>
  <ul class="menuList">
    <li
      :class="[
        'menuList__item',
        { menuList__item_active: isActiveTab === item },
      ]"
      v-for="item in items"
      :key="item"
      @click="setActiveTab(item)"
    >
      {{ item.toUpperCase() }}
    </li>
  </ul>
</template>

<script setup>
import { ref } from "@vue/reactivity";
const emit = defineEmits(["onCategoryClick"]);
const props = defineProps({
  items: {
    type: Array,
    required: true,
  },
});

let isActiveTab = ref("all");
const setActiveTab = (item) => {
  isActiveTab.value = item;
  emit("onCategoryClick", item);
};
</script>

<style scoped>
.menuList {
  display: flex;
  flex-wrap: wrap;
  padding: 0;
  list-style: none;
  gap: 15px;
}

.menuList__item {
  padding: 10px 14px;
  background-color: #fcf7eb;
  border-radius: 6px;
  cursor: pointer;
}

.menuList__item_active {
  background-color: #ffc43f;
}

@media screen and (min-width: 1024px) {
  .menuList {
    gap: 25px;
  }

  .menuList__item {
    font-family: "Open Sans";
    font-weight: 400;
    font-size: 16px;
    color: #858585;
    line-height: 22px;
    position: relative;
    padding: 0;
    background-color: transparent;
    padding: 0;
    border: none;
  }

  .menuList__item:hover {
    color: #222222;
  }

  .menuList__item_active {
    background-color: transparent;
    position: relative;
    font-weight: 600;
    color: #222222;
    cursor: default;
  }

  .menuList__item_active::after {
    content: "";
    display: block;
    position: absolute;
    top: 35px;
    left: 0;
    width: 100%;
    height: 2px;
    margin-top: 20px;
    background: #ffc43f;
  }
}
</style>
