import { RouteRecordRaw } from 'vue-router';
import { LocalStorage } from 'quasar'

// import { createPinia, setActivePinia } from 'pinia'
// ************************************************************************
// To use Pinia outside of .vue files and composable files, we first need *
// to initialize the pinia state using setActivePinia(createPinia())      *
// ************************************************************************
// setActivePinia(createPinia()) ;
// const authStore = useAuthStore() ;

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/FrontLayout.vue'),
    children: [
      { path: '', component: () => import('pages/HomePage.vue') },
      { path: 'login', component: () => import('pages/LoginPage.vue') },
    ],
  },
  {
    path: '/mail',
    component: () => import('layouts/MailLayout.vue'),
    meta: { requiresAuth: true }, /* only authenticated users can cause this route/component to load */
    beforeEnter: (to, from, next) => {
      try {
        if ( LocalStorage.getItem('loginStatus') === true ) {
          next() ;  /* continue on success */
        } else {
          next({ path: '/login' }) ; /* go back to login on failure */
        }
      } 
      catch (error) {
        next({ path: '/login' }) ; /* go back to login on failure */
      }
    },
    children: [
      { path: '', component: () => import('pages/MailPage.vue') },
      // { path: 'login', component: () => import('') },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
