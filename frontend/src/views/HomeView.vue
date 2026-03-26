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

        <button @click="submit">Submit</button>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import api from '../api/axios'

const title = ref('')
const content = ref('')
const sourceLanguage = ref('en')

const submit = async () => {
    try {
        await api.post('/api/texts', {
            title: title.value,
            content: content.value,
            source_language: sourceLanguage.value,
        })

        alert('Text saved')
    } catch (err) {
        console.error(err)
    }
}
</script>