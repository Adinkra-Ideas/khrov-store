import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
  state: () => {
    return {
      cart: [],
    };
  },

  getters: {
    productInCart: (state) => (id) => {
      return state.cart.find((productItem) => productItem.id === +id);
    },

    isProductsInCart: (state) => state.cart.length > 0,

    totalProductsAddedToCart: (state) => {
      if (state.cart.length === 0) return;
      return state.cart.reduce((totalQuantity, product) => totalQuantity + product.quantity, 0);
    },

    totalAmount: (state) => {
      if (state.cart.length === 0) return;
      return +state.cart.reduce((amount, product) => (amount += product.price * product.quantity), 0).toFixed(2);
    },
  },

  actions: {
    setProductToCart(product) {
      this.cart.push(product);
    },

    setProductsFromLStoCart(products) {
      if (!products) return;

      products.forEach((product) => this.setProductToCart(product));
    },

    incrementQuantity(productId) {
      const product = this.productInCart(productId);
      product.quantity++;
    },

    decrementQuantity(productId) {
      const product = this.productInCart(productId);
      product.quantity--;
    },

    removeProductFromCart(productId) {
      this.cart = this.cart.filter((product) => product.id !== productId);
    },

    clearCart() {
      this.$reset();
    },
  },
});
