<template>
  <form @submit.prevent="$emit('submit', client)">
    <input v-model="client.nom" placeholder="Nom" required>
    <input v-model="client.email" type="email" placeholder="Email" required>
    <button type="submit">Enregistrer</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      client: {
        nom: '',
        email: ''
      }
    }
  }
}
</script>