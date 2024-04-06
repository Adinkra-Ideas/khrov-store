<script setup lang="ts">
  import { useAuthStore } from 'stores/auth' ;

  const authStore = useAuthStore() ;

</script>

<template>
  <q-layout view="hHh lpr fff">

    <q-header elevated class="bg-secondary">
      <q-toolbar>
        <router-link to="/">
          <q-btn flat round dense icon="img:zhoumail_square.png" style="font-size:2em;" />
        </router-link>
        <q-space />
        <q-tabs>
          <router-link to="/" style="text-decoration:none;">
            <q-breadcrumbs-el name="home" label="Home" icon="home" class="cursor-pointer q-mr-md text-green-1" />
          </router-link>
          <router-link to="/mail" style="text-decoration:none;">
            <q-breadcrumbs-el name="mail" label="Mail" icon="mail" class="cursor-pointer q-mr-md text-green-1" />
          </router-link>
          <router-link to="login" style="text-decoration:none;">
            <q-breadcrumbs-el name="login" label="Login" icon="person" class="cursor-pointer q-mr-md text-green-1" v-if="!authStore.isLoggedIn.value" />
          </router-link>

          <!-- Logout button is not a link. It simply sets login status to false, so that the watcher in App.vue will take over -->
          <q-breadcrumbs-el name="logout" label="Logout" icon="account_circle" class="cursor-pointer q-mr-md text-green-1" v-if="authStore.isLoggedIn.value" @click="authStore.setLoginStatus(false)" />
        
        </q-tabs>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>

  </q-layout>
</template>
