import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Dashboard from '../components/Dashboard.vue'
import Profile from '../components/user/Profile.vue'
import CreateProfile from '../components/user/CreateProfile.vue'

const routes = [
  {
    path: '/',
    name: 'dashboard',
    component: Dashboard
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard
  },
  {
    path: '/user/profile',
    name: 'profile',
    component: Profile
  },
  {
    path: '/user/profile/create',
    name: 'profile',
    component: CreateProfile
  },
];

const router = new VueRouter({
  base: '/',
  routes,
});

export default router;
