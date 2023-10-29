import { createRouter, createWebHistory } from 'vue-router';
import CheckoutPage from '../pages/CheckoutPage.vue';
import CheckoutSuccessPage from '../pages/CheckoutSuccessPage.vue';
import HomePage from '../pages/HomePage.vue';
import ProductPage from '../pages/ProductPage.vue';
import NotFoundPage from '../pages/NotFoundPage.vue';

const routes = [
  {
    path: '/',
    component: HomePage,
  },
  {
    path: '/product/:id',
    component: ProductPage,
  },
  {
    path: '/checkout',
    component: CheckoutPage,
  },
  {
    path: '/checkout/success',
    component: CheckoutSuccessPage,
  },
  {
    path: '/:notFound(.*)',
    component: NotFoundPage,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
