import { defineStore } from 'pinia';
import { computed, ref } from 'vue'

export const useCaptchaStore = defineStore('captcha', () => {
  const captcha = ref<string>('');

  const getCaptcha = computed(() => captcha.value);

  const setCaptcha = (newCaptcha: string) => {
    captcha.value = newCaptcha;
  }

  return { 
    getCaptcha, 
    setCaptcha,
  }
})

