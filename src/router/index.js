import { createRouter, createWebHistory } from 'vue-router';
import Ajout from '../views/Ajout.vue';
import List from '../views/List.vue';
import Stat from '../views/Stat.vue';

const routes = [
  {
    path: '/',
    redirect: '/ajout'
  },
  {
    path: '/ajout',
    name: 'Ajout',
    component: Ajout
  },
  {
    path: '/list',
    name: 'List',
    component: List
  },
  {
    path: '/stat',
    name: 'Stat',
    component: Stat
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;