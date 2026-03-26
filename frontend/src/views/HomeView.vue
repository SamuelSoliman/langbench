<template>
  <div>
    <h1>Langbench</h1>

    <input v-model="title" placeholder="Title" />
    <br /><br />

    <select v-model="sourceLanguage">
      <option value="en">English</option>
      <option value="it">Italian</option>
    </select>
    <br /><br />

    <textarea v-model="content" placeholder="Paste your text here"></textarea>
    <br /><br />

    <button :disabled="!title || !content" @click="submit">
      Submit
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '../api/axios'

const router = useRouter()

const title = ref('')
const content = ref('')
const sourceLanguage = ref('en')

const submit = async () => {
  try {
    const response = await api.post('/api/texts', {
      title: title.value,
      content: content.value,
      source_language: sourceLanguage.value
    })

   
    const textId = response.data.id || response.data.data?.id

    if (!textId) {
      throw new Error('No text ID returned from API')
    }

    router.push(`/read/${textId}`)
  } catch (err) {
    console.error('Failed to create text:', err)
  }
}
</script>