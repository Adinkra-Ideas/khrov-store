export default {
  publicIndexPage: {
    labels: {
      logName: 'Username',
      logPass: 'Password',
      logSubmit: 'Submit',
      logRegister: 'Register',
      regName: 'Username',
      regPass: 'Password',
      regPassConf: 'Re-type Password',
      regEmail: 'Email',
      regEmailConf: 'Re-type Email',
      regWallet: 'Your Bitcoin Wallet Address',
      regWalletHint: 'Your Bitcoin wallet address is very important, it will be used for all your withdrawals',
      regCountry: 'Country',
      regKey: 'Security Key',
      regKeyConf: 'Re-type Security Key',
      regCaptcha: 'Captcha',
      regSubmit: 'Submit',
      regLogin: 'Login',
    },
    rules: {
      logName1: 'Username is at least 6 characters',
      logName2: 'AlphaNumerics and ‘.’ Characters only',
      logName3: 'Username cannot exceed 12 Characters',
      logPass1: 'Please type your password',
      regName1: 'Please enter your username',
      regName2: 'AlphaNumerics and ‘.’ Characters only, 6-12 chars',
      regPass1: 'Please enter your password',
      regPass2: 'AlphaNumerics and “.@#” symbol only, min 6 chars and max 12 chars long',
      regPassConf1: 'Please re-type your password',
      regPassConf2: 'Passwords mismatch',
      regEmail1: 'Invalid email',
      regEmailConf1: 'Email address mismatch',
      regWallet1: 'Please enter your Bitcoin Wallet Address',
      regWallet2: 'Bitcoin Wallet Address',
      regCountry1: 'Please select Country',
      regKey1: 'Create new Security Key',
      regKey2: 'Only AlphaNumerics, min 6 chars and max 12 chars long',
      regKeyConf1: 'Security Key mismatch',
      regCaptcha1: 'Please type Catcha code',
      regCaptcha2: 'Wrong Captcha Code!',

    },
    html: {
      logOption: 'Stay logged in',
      loqQuestion: 'No account?',
      regNoCountry: 'No results',
      regQuestion: 'Already Registered?',
    },


  },

  
};

