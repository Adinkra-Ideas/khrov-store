import { defineStore } from 'pinia';

export const useCommonStore = defineStore('common', {
  state: () => {
    return {
      isCartModalOpen: false,
      isLikesModalOpen: false,
    };
  },

  actions: {
    openModal(modal) {
      switch (modal) {
        case 'cart':
          this.isCartModalOpen = true;
          break;
        case 'likes':
          this.isLikesModalOpen = true;
          break;
        default:
          this.isCartModalOpen = true;
      }
    },

    closeModal(modal) {
      switch (modal) {
        case 'cart':
          this.isCartModalOpen = false;
          break;
        case 'likes':
          this.isLikesModalOpen = false;
          break;
        default:
          this.isCartModalOpen = false;
      }
    },
  },
});
