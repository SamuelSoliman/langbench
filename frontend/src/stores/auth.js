import { defineStore } from 'pinia'
import api from '../api/axios'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || null,
  }),

  actions: {
    async login(email, password) {
      try {
        const response = await api.post('/api/login', {
          email,
          password,
        })

        const token = response.data.token
        const user = response.data.user

        this.token = token
        this.user = user

        localStorage.setItem('token', token)

        return response.data
      } catch (error) {
        console.error('Login failed:', error)
        throw error
      }
    },

    async register(name, email, password) {
      try {
        const response = await api.post('/api/register', {
          name,
          email,
          password,
        })

        return response.data
      } catch (error) {
        console.error('Register failed:', error)
        throw error
      }
    },

    logout() {
      this.user = null
      this.token = null

      localStorage.removeItem('token')
    },
  },
})
