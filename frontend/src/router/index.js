import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import HomeView from '../views/HomeView.vue'
import {isGuest , isAuth} from "../guard/Guard"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      component: LoginView,
      beforeEnter: isGuest
    },
    {
      path: '/register',
      component: RegisterView,
      beforeEnter: isGuest
    },
    {
      path: "/",
      component: HomeView,
      beforeEnter: isAuth
    }
  ]
})

export default router
