import { ref } from 'vue';

export const useQuantity = () => {
  const quantity = ref(1);

  const incrementQuantity = () => {
    quantity.value += 1;
  };

  const decrementQuantity = () => {
    quantity.value -= 1;
  };

  return [quantity, incrementQuantity, decrementQuantity];
};
