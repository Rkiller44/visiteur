import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home.vue'
import AjoutView from '../views/Ajout.vue'
import ListView from '../views/List.vue'
import StatView from '../views/Stat.vue'


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/Ajout',
    name: 'ajout',
    component: AjoutView
  },
  {
    path: '/List',
    name: 'list',
    component: ListView
  },
  {
    path: '/Stat',
    name: 'stat',
    component: StatView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
