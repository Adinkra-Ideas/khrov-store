<template>
  <div class="star-rating">
    <div class="star-rating__stars">
      <span v-for="star in starLimit" :key="star">
        <BaseIcon fill="lightgray">
          <StarIcon />
        </BaseIcon>
      </span>

      <div class="star-rating__contained">
        <span v-for="star in starLimit" :key="star">
          <BaseIcon fill="#ffa801">
            <StarIcon />
          </BaseIcon>
        </span>
      </div>
    </div>

    <span class="star-rating__number">{{ rating }}</span>
  </div>
</template>

<script setup>
import BaseIcon from "./UI/BaseIcon.vue";
import StarIcon from "@/components/icons/StarIcon.vue";
import { computed } from "@vue/runtime-core";

const props = defineProps({
  rating: {
    type: Number,
    required: true,
  },
  starLimit: {
    type: Number,
    default: 5,
  },
});

const ratingWidth = computed(() => (props.rating * 100) / props.starLimit);
</script>

<style scoped>
.star-rating {
  display: flex;
  gap: 15px;
}

.star-rating__stars {
  position: relative;
}

.star-rating__contained {
  display: inline-flex;
  position: absolute;
  top: 0;
  left: 0;
  overflow: hidden;
  width: v-bind(ratingWidth + "%");
}

.star-rating__number {
  font-weight: 600;
}
</style>
