import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  // This is a layout AKA Dashboard. The main layout ideally being the sidebar
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/PublicIndexPage.vue') },
      // { path: 'login', component: () => import('') },
    ],
  },
  // more layouts can be added z.B /admin for admin panel layout/Dashboard


  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
