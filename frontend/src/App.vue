<!-- <script setup>
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()

const handleLogin = async () => {
  await auth.login('tes3t@test.com', 'password')
}
</script>

<template>
  <button @click="handleLogin">
    Login
  </button>
</template> -->
<template>
  <div>
    <nav style="padding: 10px; border-bottom: 1px solid #ccc;">
      <router-link to="/">Home</router-link> |
      <router-link to="/login">Login</router-link> |
      <router-link to="/register">Register</router-link>
    </nav>

    <router-view />
  </div>
</template>