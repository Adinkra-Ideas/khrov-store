<script setup lang="ts">
  import { useMailLayoutComposable } from 'src/composables/MailLayoutComposable' ;
  import { useAuthStore } from 'stores/auth' ;

  const authStore = useAuthStore() ;

  const {
    leftDrawerOpen,
    toggleLeftDrawer,
    
  } = useMailLayoutComposable() ;

</script>

<template>
  <q-layout view="hHh LpR lFf">

    <q-header elevated class="bg-secondary text-white" height-hint="98">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />
        <router-link to="/">
          <q-btn flat round dense icon="img:zhoumail_square.png" class="q-ml-sm" style="font-size:2em;" />
        </router-link>
        <q-space />  
        <q-tabs>
          <router-link to="/" style="text-decoration:none;">
            <q-breadcrumbs-el name="home" label="Home" icon="home" class="cursor-pointer q-mr-md text-green-1" />
          </router-link>
          <router-link to="login" style="text-decoration:none;">
            <q-breadcrumbs-el name="login" label="Login" icon="person" class="cursor-pointer q-mr-md text-green-1" v-if="!authStore.isLoggedIn.value" />
          </router-link>

          <!-- Logout button is not a link. It simply sets login status to false, so that the watcher in App.vue will take over -->
          <q-breadcrumbs-el name="logout" label="Logout" icon="account_circle" class="cursor-pointer q-mr-md text-green-1" v-if="authStore.isLoggedIn.value" @click="authStore.setLoginStatus(false)" />
        
        </q-tabs>      
      </q-toolbar>
    </q-header>
    
    <!-- 
      // ********************************************************************************
      // The show-if-above attribute means this q-drawer block must be visible upon     *
      // page load if the screen width is greater than 1022. Else its visibility will   *
      // depend on whether its v-model=== true or false.                                *
      //                                                                                *
      // The v-model="leftDrawerOpen" is simple. Remember that v-model is not simply    *
      // just for copying values into a variable automatically, it is value="" in its   *
      // basic form.                                                                    *
      // q-drawer needs a value="true" attribute in order to render. This is where the  *
      // v-model="leftDrawerOpen" comes in.                                             *
      //                                                                                *
      // The side="left" means this q-drawer should appear on the left side of the      *
      // screen AKA bind to the 'l' part of view="lHh LpR lff"                          *
      // ********************************************************************************
    -->
    <q-drawer show-if-above v-model="leftDrawerOpen" side="left" class="q-pt-md" bordered>
      <q-btn 
        class="glossy q-my-md q-ml-md q-py-sm q-px-lg block" 
        rounded 
        color="deep-orange" 
        icon="edit" 
        label="Compose" 
        style="font-size:15px;" 
        no-caps 
        disabled 
      />
      <q-btn flat color="primary" icon="inbox" label="Inbox" class="full-width q-pr-xl bg-blue-1" align="left" no-caps />
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>

  </q-layout>
</template>
