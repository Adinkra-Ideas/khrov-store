<script setup lang="ts">
  import { useLoginPageComposable } from 'src/composables/LoginPageComposable' ;

  const {
    loginOrReg,
    isLoginPwd,
    loginProblem,
    login,
    onLoginSubmit,

  } = useLoginPageComposable() ;

</script>

<template>
  <q-page class="q-mb-xl q-mx-auto" style="width:90%;max-width:350px;">
    <q-img
      class="q-mb-sm"
      src="login_top.png"
      spinner-color="white"
      style="width: 100%; height: auto"
    />
    <div v-if="loginOrReg===true">
      
      <!-- CREATING THE LOGIN FORM BEGINS -->
      <!-- 
      // **********************************************************************************************
      // The (@submit.prevent'="onLoginSubmit") option means there will be a button inside this form  *
      // with type="submit" set to it.                                                                *
      // When this button is clicked to submit this form, our onLoginSubmit function will be called.  *
      //                                                                                              *
      // The (@reset="loginOrReg=false") option means there will be a button inside this form with    *
      // type="reset" set to it.                                                                      *
      // When this button is clicked to reset this form, our "loginOrReg" variable will be set to     *
      // false. Remember that when loginOrReg === false, it means the register form will be shown     *
      // rather than login form                                                                       *
  	  //                                                                                              *
      // The (class="q-gutter-md") means the form should be a flex with gutter(rows and columns)      *
      // having a medium spacing inbetween.                                                           *
      // **********************************************************************************************
      -->
      <q-form
        @submit.prevent="{
          if ( onLoginSubmit() === true ) {
            // ****************************************************************
            // This Will Refresh The Whole Browser if log in was successful.  *
            // A refresh of the browser is necessary for a clean login.       *
            // For some reason, the Watch in App.vue cant detect when the     *
            // authStore.isLoggedIn.value switches to true. Therefore we      *
            // wrote an if condition that gets called when the App.vue is     *
            // mounted. And in order for the App.vue to be mounted, we need   *
            // to reload the whole browser after login.                       *
            // ****************************************************************
            $router.go(0) ;
          }
        }"
        @reset="loginOrReg=false"
        class="q-gutter-md"
      >
        <q-input
          filled
          clearable
          v-model="login.user"
          label="Username *"
          lazy-rules
          :rules="[ 
            val => val && val.length >= 6 || 'Username is at least 6 Characters',
            val => val && val.match(/^[a-zA-Z\d.@]{6,}$/) || 'AlphaNumerics, ‘@’ and ‘.’ Characters only',
            val => val && val.length <= 50 || 'Username cannot exceed 12 Characters',
          ]"
          autocomplete="username"
        />

        <q-input
          filled
          v-model="login.pass"
          label="Password *"
          lazy-rules
          :rules="[
            val => val && val.length > 0 || 'Please type your password',
            val => val && val.length >= 6 || 'Password is at least 6 Characters',
          ]"
          :type="isLoginPwd ? 'password' : 'text'"
          autocomplete="current-password"
        >
        <!-- 
          // **************************************************************************
          // This means that although q-input has props (which we initialized above), *
          // it also uses Slots. Below we are initializing the slot named 'append'    *
          // located inside q-input component.                                        *
          // This append slot is an empty box to the right end of q-input component.  *
          // 'v-slot:append' can also be written as '#append'                         *
          //                                                                          *
          // Inside this empty box created by append Slot, we are putting a           *
          // <q-icon name="visibility_off" /> and <q-icon name="visibility" />;       *
          // the first being the closed eyes which means password are not shown,      *
          // while the second being opened eyes which means password are shown.       *
          //                                                                          *
          // (class="cursor-pointer") means that a CSS of cursor: pointer' should     *
          // be added to this eyes.                                                   *
          //                                                                          *
          // (@click="isLoginPwd = !isLoginPwd") is simply a toggling off and on of   *
          // the isLoginPwd var whose state determines whether the q-icon will equal  *
          // visibility_off(eyes closed) or visibility(eyes open)                     *
          // **************************************************************************
         -->
          <template v-slot:append>
            <q-icon
              :name="isLoginPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isLoginPwd = !isLoginPwd"
            />
          </template>
        </q-input>

        <!-- 
          // ********************************************************************
          // q-toggle puts a toggle button out.                                 *
          // When clicked, it turns on and its value will equal true(boolean).  * 
          // When clicked again, it turns off and its value will equal false.   *
          // ********************************************************************
         -->
        <q-toggle v-model="login.stay" :label="'Stay logged in'" />

        <div>
          <q-btn :label="'Submit'" type="submit" color="deep-orange" class="glossy" />
          &nbsp;{{'No account?'}}
          <q-btn :label="'Register'" type="reset" color="primary" flat class="q-ml-sm" />
        </div>

      </q-form>
    </div>
    <!-- CREATING THE LOGIN FORM ENDS -->

    <!-- CREATING THE REGISTER PAGE BEGINS -->
    <div v-if="loginOrReg===false">
      <div class="text-h6 text-uppercase text-center">
        Notice of End of Service
      </div>
      <div class="text-body1 q-mt-sm">
        <p>
          Dear ZhouMail User,
        </p>
      </div>
      <div class="text-body2">
        <p>
          ZhouMail email service has been discontinued on November 30, 2023.
          This means you will no longer be able to register new email accounts.
        </p>
        <p>
          Existing email users will still have access to their message inbox, 
          but they will no longer be able to send or receive new email messages.
        </p>
        <p>
          Thanks for your cooperation.
        </p>
      </div>
      <div>
        <q-btn 
          :label="'Back to Login'" 
          color="deep-orange" 
          class="glossy q-mb-lg"
          @click="loginOrReg=true" />
      </div>
    </div>
    <!-- CREATING THE REGISTER PAGE ENDS -->
    
    <div 
      v-if="loginProblem.length"
      class="text-center text-negative bg-warning q-my-sm"
    >
      {{ loginProblem }}
    </div>

  </q-page>
</template>
