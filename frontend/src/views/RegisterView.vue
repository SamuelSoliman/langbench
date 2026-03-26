<template>
  <div>
    <h1>Register</h1>

    <input v-model="name" placeholder="Name" />
    <br /><br />

    <input v-model="email" placeholder="Email" />
    <br /><br />

    <input v-model="password" type="password" placeholder="Password" />
    <br /><br />

    <button @click="handleRegister">Register</button>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useAuthStore } from '../stores/auth' 
import { useRouter } from 'vue-router'

const name = ref('')
const email = ref('')
const password = ref('')

const auth = useAuthStore()
const router = useRouter()

const handleRegister = async () => {
  try {
    await auth.register(name.value, email.value, password.value)


    await auth.login(email.value, password.value)

    router.push('/')
  } catch (err) {
    console.error(err)
  }
}
</script>