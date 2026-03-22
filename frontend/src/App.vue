<template>
  <div class="p-4">
    <button
      class="px-4 py-2 bg-blue-500 text-white rounded"
      @click="testApi"
    >
      Test API
    </button>
  </div>
</template>

<script setup>
import api from './api/axios'

// this function will call your backend
const testApi = async () => {
  try {
    const res = await api.get('/api/test')
    console.log('API response:', res.data)
  } catch (error) {
    console.error('API error:', error)
  }
}
</script>
