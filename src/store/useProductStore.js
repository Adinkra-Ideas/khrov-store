import { wait } from '@/utils/helpers';
import { defineStore } from 'pinia';

const FETCH_ATTEMPTS_COUNT = 3;
const FETCH_DELAY_REQUEST_MS = 3000;
const BASE_URL = 'https://fakestoreapi.com/products';
const FETCH_ERROR_MESSAGE = "Something went wrong. I'll try to fetch data again in";
const SERVER_ERROR_MESSAGE = 'We are sorry. Server is temporarily down. Please try again later';

export const useProductStore = defineStore('products', {
  state: () => {
    return {
      products: [],
      isLoading: false,
      error: {
        isError: false,
        message: null,
        errorCode: null,
        type: null,
        timeout: null,
      },
      serverStatus: {
        isDown: false,
        message: null,
      },
    };
  },

  getters: {
    isProducts: (state) => state.products.length > 0,
    allCategories: (state) => {
      const tmp = state.products.map((product) => product.category);
      tmp.unshift('all');
      return [...new Set(tmp)];
    },

    product: (state) => (id) => {
      return state.products.find((item) => item.id === +id);
    },
  },

  actions: {
    async fetchProducts(attempt = 1) {
      try {
        this.isLoading = true;

        const response = await fetch(BASE_URL);

        if (!response.ok) {
          await wait(1000);
          throw new Error(FETCH_ERROR_MESSAGE, { cause: { status: response.status } });
        }

        this.products = await response.json();
      } catch (e) {
        this.isLoading = false;

        if (attempt <= FETCH_ATTEMPTS_COUNT) {
          this.error = {
            isError: true,
            message: e.message,
            errorCode: e.cause.status,
            timeout: attempt * (FETCH_DELAY_REQUEST_MS / 1000),
          };

          await wait(attempt * FETCH_DELAY_REQUEST_MS);
          return this.fetchProducts(attempt + 1);
        }

        this.serverStatus = { isDown: true, message: SERVER_ERROR_MESSAGE };
      } finally {
        this.isLoading = false;
      }
    },
  },
});
