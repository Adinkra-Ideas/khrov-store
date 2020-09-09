<template>
  <FailedHttpRequest
    :errorCode="error.errorCode"
    :errorMessage="error.message"
    :timeout="error.timeout"
    :serverIsDown="serverStatus.isDown"
    :serverErrorMessage="serverStatus.message"
    v-if="error?.isError && !isLoading"
  />

  <div class="product-page" v-else>
    <Loader v-if="isLoading" />
    <BaseCard class="product-page__card" v-else>
      <img
        :src="product.image"
        :alt="product.title"
        class="product-page__card-image"
      />
      <div class="product-page__card-content">
        <BaseHeading variant="h1" class="product-page__card-title"
          >{{ product.title }}
        </BaseHeading>

        <BaseDivider />
        <div class="product-page__card-rating">
          <StarRating :rating="product.rating.rate" />

          <BaseIconButton
            @click="like"
            variant="contained"
            :text="likeBtnText"
            iconColor="lightgray"
            iconHoverColor="#ef2525"
            iconActiveColor="#ef2525"
            :isActive="isProductLiked"
            opacity="0.5"
            :class="likeClass"
          >
            <LikeIcon />
          </BaseIconButton>
        </div>
        <div class="product-page__card-actions">
          <BaseHeading variant="h2">${{ product.price }}</BaseHeading>
          <div class="product-page__card-actions-buy">
            <QuantityBlock
              @decrement="decrementQuantity"
              @increment="incrementQuantity"
              :quantity="quantity"
              v-if="!isProductAlreadyInCart"
            />
            <BaseButton
              variant="contained"
              mode="success"
              @click="addToCart"
              v-if="!isProductAlreadyInCart"
              >Add to cart</BaseButton
            >

            <BaseButton
              @click="openModal('cart')"
              variant="contained"
              mode="success"
              v-else
              >Already is in your Cart</BaseButton
            >
          </div>
        </div>
        <div class="product-page__card-description">
          <BaseHeading variant="h3">Description</BaseHeading>
          <p>
            {{ product.description }}
          </p>
        </div>
      </div>
    </BaseCard>
  </div>
</template>

<script setup>
import BaseHeading from "@/components/UI/BaseHeading.vue";
import QuantityBlock from "@/components/UI/QuantityBlock.vue";
import BaseButton from "@/components/UI/Buttons/BaseButton.vue";
import BaseCard from "@/components/UI/BaseCard.vue";
import BaseDivider from "@/components/UI/BaseDivider.vue";
import StarRating from "@/components/StarRating.vue";
import Loader from "@/components/UI/Loader.vue";
import BaseIconButton from "@/components/UI/Buttons/BaseIconButton.vue";
import LikeIcon from "@/components/icons/LikeIcon.vue";
import FailedHttpRequest from "@/components/FailedHttpRequest.vue";
import { computed } from "@vue/runtime-core";
import { useRoute } from "vue-router";
import { useProductStore } from "@/store/useProductStore";
import { storeToRefs } from "pinia";
import { useLikeStore } from "@/store/useLikeStore";
import { useCartStore } from "@/store/useCartStore";
import { useCommonStore } from "@/store/useCommonStore";
import { useQuantity } from "@/hooks/quantity.js";

const route = useRoute();
const [quantity, incrementQuantity, decrementQuantity] = useQuantity();

const productStore = useProductStore();
const likeStore = useLikeStore();
const cartStore = useCartStore();
const commonStore = useCommonStore();
const { isLoading, error, serverStatus } = storeToRefs(productStore);

const product = computed(() => {
  const thisProduct = productStore.product(route.params.id);
  return {
    ...thisProduct,
    quantity: quantity.value,
  };
});

const isProductLiked = computed(
  () => likeStore.likedProduct(product.value.id) !== undefined
);

const likeBtnText = computed(() =>
  isProductLiked.value ? "In your wishlist" : "Add to wishlist"
);

const isProductAlreadyInCart = computed(
  () => cartStore.productInCart(route.params.id) !== undefined
);

const likeClass = computed(() => [
  "product-page__card-like",
  isProductLiked.value && "product-page__card-like_active",
]);

const openModal = (modal) => {
  commonStore.openModal(modal);
};

const like = () => {
  likeStore.handleLikes(product.value);
};

const addToCart = () => {
  cartStore.setProductToCart(product.value);
  openModal("cart");
};
</script>

<style scoped>
.product-page {
  position: relative;
}
.product-page__card {
  display: grid;
  gap: 20px;
}

.product-page__card-title {
  text-align: left;
  font-size: 28px;
  line-height: 34px;
}

.product-page__card-rating {
  width: 100%;
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
}

.product-page__card-like {
  display: flex;
  align-items: center;
}

.product-page__card-like_active {
  color: #ef2525;
}

.product-page__card-like:hover {
  color: #ef2525;
  fill: #ef2525;
}

.product-page__card-image {
  display: block;
  width: 100%;
}

.product-page__card-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 24px;
}

.product-page__card-actions {
  display: flex;
  flex-direction: column;
  gap: 20px;
  align-items: center;
}

.product-page__card-actions-buy {
  display: flex;
  flex-direction: column;
  gap: 20px;
  align-items: center;
}

.product-page__card-description {
  display: flex;
  flex-direction: column;
  gap: 5px;
  text-align: left;
}

@media screen and (min-width: 768px) {
  .product-page__card {
    padding: 30px;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
  }

  .product-page__card-content {
    align-items: flex-start;
  }

  .product-page__card-title {
    font-size: 36px;
    line-height: 40px;
  }

  .product-page__card-actions {
    align-items: flex-start;
  }

  .product-page__card-actions-buy {
    flex-direction: row;
  }
}

@media screen and (min-width: 1024px) {
  .product-page__card-image {
    max-width: 600px;
    max-height: 600px;
    object-fit: contain;
  }
}
</style>
