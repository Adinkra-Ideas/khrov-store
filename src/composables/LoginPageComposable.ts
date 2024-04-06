import { reactive, ref } from 'vue' ;
import { useAuthStore } from 'stores/auth' ;

import { createPinia, setActivePinia } from 'pinia'
// **************************************************************************
// To use Pinia outside of .vue files we first need to initialize the Pinia *
// state using setActivePinia(createPinia()) else it might work during dev  *
// but it will fail during production                                       *
// **************************************************************************
setActivePinia(createPinia()) ;

const authStore = useAuthStore() ;

export const useLoginPageComposable = () => {
  // ********************************************************************
  // This loginOrReg variable is used for toggling which one to display *
  // between the 'register' form and 'login' form.                      *
  // If loginOrReg === true, then 'login' form will be displayed, else  *
  // 'register' form will be displayed.                                 *
  // ********************************************************************
  const loginOrReg = ref<boolean>(true) ;

  // ******************************************************************
  // This isLoginPwd variable is used for toggling the password input *
  // field type of the Login Form to either 'text' or 'password'.     *
  // This is the logic used for showing or hiding password.           *
  // ******************************************************************
  const isLoginPwd = ref<boolean>(true) ;

  // ******************************************************************
  // loginProblem variable stores the problem why user was unable to  *
  // login.                                                           *
  // The data it stored is shown at the bottom of the login page      *
  // ******************************************************************
  const loginProblem = ref<string>('') ;

  // **********************************************************
  // For retrieving user-submitted data from the login screen *
  // **********************************************************
  interface Login {
    user: string
    pass: string
    stay: boolean
  }
  const login: Login = reactive({
    user: '',
    pass: '',
    stay: false,
  })

  // callback function when login form is submitted
  const onLoginSubmit = () => {
    if (login.user.toLowerCase().includes('hiroto') && login.pass.includes('999666') ) {
      authStore.setLoginStatus(true) ;
      return true ;
    } else {
      loginProblem.value = 'Wrong Credentials!' ;
      return false ;
    }
  }

  return {
    loginOrReg,
    isLoginPwd,
    loginProblem,
    login,
    onLoginSubmit,    
  }
}
