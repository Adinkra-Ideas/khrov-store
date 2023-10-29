import { defineStore } from 'pinia';

export const useLikeStore = defineStore('like', {
  state: () => {
    return {
      likes: [],
    };
  },

  getters: {
    likedProduct: (state) => (id) => {
      return state.likes.find((productItem) => productItem.id === +id);
    },

    isLikes: (state) => state.likes.length > 0,

    totalLikes: (state) => {
      if (state.likes.length === 0) return;
      return state.likes.length;
    },
  },

  actions: {
    handleLikes(product) {
      const likedProduct = this.likedProduct(product.id);

      if (likedProduct) {
        this.likes = this.likes.filter((item) => item.id !== product.id);
        return;
      }
      this.likes.push(product);
    },
    setLikesFromLS(products) {
      if (!products) return;

      products.forEach((product) => this.handleLikes(product));
    },
  },
});
