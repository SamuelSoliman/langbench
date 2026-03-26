import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
import ReaderView from '../views/ReaderView.vue'
import QuizView from '../views/QuizView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'

// TO BE improved
const isAuthenticated = () => {
  return !!localStorage.getItem('token')
}
console.log('Is authenticated:', isAuthenticated()) // Debug log to check authentication status
const routes = [
  {
    path: '/',
    component: HomeView,
    meta: { requiresAuth: true }
  },
  {
    path: '/read/:id',
    component: ReaderView,
    meta: { requiresAuth: true }
  },
  {
    path: '/quiz/:id',
    component: QuizView,
    meta: { requiresAuth: true }
  },
  {
    path: '/login',
    component: LoginView
  },
  {
    path: '/register',
    component: RegisterView
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})


router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !isAuthenticated()) {
    return next('/login')
  }
  next()
})

export default router