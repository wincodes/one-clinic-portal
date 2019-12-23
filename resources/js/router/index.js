import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Dashboard from '../components/Dashboard.vue'

const routes = [
  {
    path: '/',
    name: 'landmark',
    component: Dashboard
  },
];

const router = new VueRouter({
  mode: 'history',
  base: '/dashboard',
  routes,
});

export default router;
