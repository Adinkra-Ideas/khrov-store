import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { LocalStorage } from 'quasar'

export const useAuthStore = defineStore('auth', () => {  

  const loginStatus = ref( LocalStorage.getItem('loginStatus') ) ;
  const isLoggedIn = computed(() => loginStatus) ;

  const setLoginStatus = (newStatus: boolean) => {
    LocalStorage.set('loginStatus', newStatus) ;
    loginStatus.value = LocalStorage.getItem('loginStatus') ;
  }

  return {
    isLoggedIn,
    setLoginStatus,

  }
})
