<template>
  <header class="header">
    <router-link
      to="/"
      :class="[
        'header__logo',
        isHomepage ? 'header__logo-disabled' : 'header__logo_active',
      ]"
      disabled="true"
    >
      <img src="@/assets/logo.svg" class="header__logo" />
    </router-link>

    <ul>
      <li>
        <BaseButtonWithBadge :quantity="totalLikes" @click="openModal('likes')">
          <LikeIcon />
        </BaseButtonWithBadge>
      </li>

      <li>
        <BaseButtonWithBadge
          :quantity="totalProductsAddedToCart"
          @click="openModal('cart')"
        >
          <CartIcon />
        </BaseButtonWithBadge>
      </li>
    </ul>
  </header>
</template>

<script setup>
import { useCartStore } from "@/store/useCartStore";
import { useCommonStore } from "@/store/useCommonStore";
import { useLikeStore } from "@/store/useLikeStore";
import { computed } from "@vue/runtime-core";
import { storeToRefs } from "pinia";
import { useRoute } from "vue-router";

import CartIcon from "./icons/CartIcon.vue";
import LikeIcon from "./icons/LikeIcon.vue";
import BaseButtonWithBadge from "./UI/Buttons/BaseButtonWithBadge.vue";

const route = useRoute();

const cartStore = useCartStore();
const likeStore = useLikeStore();
const commonStore = useCommonStore();

const { totalProductsAddedToCart } = storeToRefs(cartStore);
const { totalLikes } = storeToRefs(likeStore);

const isHomepage = computed(() => route.fullPath === "/");

const openModal = (modal) => {
  commonStore.openModal(modal);
};
</script>

<style scoped>
.header {
  display: grid;
  align-items: center;
  gap: 20px;
  grid-template-columns: 1fr 1fr;
  padding: 0 10px;
}

.header__logo {
  width: 110px;
  justify-self: start;
  text-decoration: none;
}

ul {
  display: flex;
  gap: 14px;
  justify-self: end;
  list-style: none;
  padding: 0;
}

.header__logo-disabled {
  pointer-events: none;
}

.header__logo_active {
  color: #ffa801;
}

.header__logo_active:hover {
  opacity: 0.6;
  transition: opacity 0.3s ease-in;
}

@media screen and (min-width: 768px) {
  .header__logo {
    width: 160px;
  }

  ul {
    gap: 25px;
  }
}
</style>
