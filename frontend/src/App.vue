<script setup>
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
</template>