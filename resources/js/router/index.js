import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Dashboard from '../components/Dashboard.vue'
import Profile from '../components/user/Profile.vue'
import CreateProfile from '../components/user/CreateProfile.vue'
import EditProfile from '../components/user/EditProfile.vue'

const routes = [
  {
    path: '/',
    name: 'index',
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
    name: 'create-profile',
    component: CreateProfile
  },
  {
    path: '/user/profile/edit',
    name: 'edit-profile',
    component: EditProfile
  },
];

const router = new VueRouter({
  base: '/',
  routes,
});

export default router;
