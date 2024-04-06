<script setup lang="ts">
  import { watch } from 'vue'
  import { useAuthStore } from 'stores/auth' ;
  import { useRouter } from 'vue-router'

  const authStore = useAuthStore() ;
  const router = useRouter() ;

  // **********************************************************************************
  // Due to the fact that the Watch cannot detect a login when authStore.isLoggedIn's *
  // changes to true, but it can detect a logout when the value changes to false, I   *
  // the browser reload upon login so that this App.vue will be remounted. That means *
  // this if will trigger and push the user to their email dashboard if the           *
  // authStore.isLoggedIn.value === true                                              *
  // **********************************************************************************
  if ( authStore.isLoggedIn.value === true ) {
    router.push({ path: '/mail' }) ;
  }

  // ************************************************************************
  // This watch watches the authStore.isLoggedIn.value to know if the state *
  // changes.                                                               *
  // For some reson it cannot detect a login when authStore.isLoggedIn's   *
  // changes to true, but it can detect a logout when the value changes to  *
  // false.                                                                 *
  // else if authStore.isLoggedIn.value's value changes to false, they will *
  // get pushed into / path which is the home login                         *
  // ************************************************************************
  watch(authStore.isLoggedIn, async (newStatus) => {
    if (newStatus === false) {
      router.push({ path: '/login' }) ;
    }
  })




  // **********************************************************************
  // CHANGES WHEN CREATING A NEW COIN SITE                                *
  //                                                                      *
  // 1) Goto src/pages/MailPage.vue and replace all 'AsianCoin',          *
  // 2) On same src/pages/MailPage.vue, change the value of 'Username:'   *
  //    into your new COIN SITE username and the value of 'Password:'     *
  //    into your new COIN SITE password.                                 *
  // **********************************************************************

  // ********************************************************************
  // TO CHANGE THE EMAIL LOGIN AND PASSWORD (Rarely)                    *
  //                                                                    *
  // 1) gOTO src/composables/LoginPageComposable.ts and inside the      *
  //    onLoginSubmit(), change the email username and email password   *
  //    currently in use that is stored there.                          *
  // ********************************************************************

</script>

<template>
  <router-view />
</template>
