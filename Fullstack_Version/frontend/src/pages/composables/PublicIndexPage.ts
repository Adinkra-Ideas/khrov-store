import { reactive, ref } from 'vue'
import type {
  Register,
} from 'pages/interface/pages'
import { usePagesGlobal } from 'pages/composables/__PagesGlobal'
import { useCaptchaStore } from 'stores/captcha-store'

export function PublicIndexPage() {
  const loginOrReg = ref<boolean>(true); // If value===true, login screen is shown, Else if value===false, register screen is shown
  const isLoginPwd = ref<boolean>(true); // For toggling password box to text and back for Login
  const isRegPwd = ref<boolean>(true);   // For toggling password box to text and back for Registration
  const register: Register = reactive({  // For retrieving user-submitted data from the Register screen
    user: '',
    pass: '',
    passConfirm: '',
    email: '',
    emailConf: '',
    wallet: '',
    country: '',
    key: '',
    keyConf: '',
    captcha: ''
  })

  const { server, fetchForKhrov } = usePagesGlobal();

  const onRegisterSubmit = async (reg: Register) => {
    const tmp = {
      username: reg.user,
      password: reg.pass,
      secureKey: reg.key,
      email: reg.email,
      walletAddr: reg.wallet,
      country: reg.country,
      captcha: reg.captcha
    }
    const response = await fetchForKhrov('/api/register', 'POST', tmp);
    if (response) {
      try {
        if (!response.ok) throw response;
        const jsonObj = await response.json();
        // message will be assigned to banner here. And if message is success, router will push to email verif
        console.log(jsonObj.message);
      } catch {/* Do nothing */}
    }
  }

  const captchaStore = useCaptchaStore()

  const getCaptcha = async () => {
    const response = await fetchForKhrov('/captcha/gen', 'POST', {});
    if (response) {
      try {
        if (!response.ok) throw response;
        const jsonObj = await response.json();
        captchaStore.setCaptcha( jsonObj.message );
      } catch {/* Do nothing */}
    }
  }

  const validateCaptcha = async (inputCode: string): Promise<boolean> => {
    const tmp = {
      captcha: inputCode,
    }
    const response = await fetchForKhrov('/captcha/validate', 'POST', tmp);
    getCaptcha();
    if (! response) return false;
    try {
      if (!response.ok) return false;
      const jsonObj = await response.json();
      if ( jsonObj.message === 'correct!') {
        return true;
      }
    } catch {/* Do nothing */}
    return false;
  } 

  return {
    loginOrReg,
    isLoginPwd,
    isRegPwd,
    register,
    fetchForKhrov,
    onRegisterSubmit,
    getCaptcha,
    validateCaptcha,
  }

}
