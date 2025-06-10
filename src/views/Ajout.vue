<template>
  <div class="ajout-container">
    <h2>Ajout d'un visiteur</h2>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label>Nom :</label>
        <input v-model="visiteur.nom" required>
        <span class="error-message" v-if="erreurs.nom">{{ erreurs.nom }}</span>
      </div>
      <div class="form-group">
        <label>Nombre de jours :</label>
        <input v-model.number="visiteur.nombre_jours" type="number" required>
        <span class="error-message" v-if="erreurs.jours">{{ erreurs.jours }}</span>
      </div>
      <div class="form-group">
        <label>Tarif journalier :</label>
        <input v-model.number="visiteur.tarif_journalier" type="number" step="0.01" required>
        <span class="error-message" v-if="erreurs.tarif">{{ erreurs.tarif }}</span>
      </div>
      <button type="submit">Ajouter</button>
    </form>
    <div v-if="message" :class="['message', success ? 'success' : 'error']">
      {{ message }}
    </div>
  </div>
</template>

<script>
export default {
  
  data() {
    return {
      visiteur: {
        nom: '',
        nombre_jours: 0,
        tarif_journalier: 0
      },
      erreurs: {
        jours: '',
        tarif: ''
      },
      message: '',
      success: false
    }
  },

  computed: {
    formulaireValide() {
      return this.visiteur.nombre_jours > 0 && 
             this.visiteur.tarif_journalier > 0 &&
             !this.erreurs.jours && 
             !this.erreurs.tarif;
    }
  },

  methods: {

     validerJours() {
      if (this.visiteur.nombre_jours <= 0) {
        this.erreurs.jours = 'Doit être supérieur à 0';
      } else if (!Number.isInteger(this.visiteur.nombre_jours)) {
        this.erreurs.jours = 'Doit être un nombre entier';
      } else {
        this.erreurs.jours = '';
      }
    },

     validerTarif() {
      if (this.visiteur.tarif_journalier <= 0) {
        this.erreurs.tarif = 'Doit être supérieur à 0';
      } else if (isNaN(this.visiteur.tarif_journalier)) {
        this.erreurs.tarif = 'Doit être un nombre valide';
      } else {
        this.erreurs.tarif = '';
      }
    },

    async submitForm() {

      this.validerJours();
      this.validerTarif();

      if (!this.formulaireValide) {
        this.message = 'Veuillez corriger les erreurs dans le formulaire';
        this.success = false;
        return;
      }

      try {
        const response = await fetch('/api/api/visiteurs.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.visiteur)
        });
        
        const result = await response.json();
        this.message = result.message;
        this.success = result.success;
        
        if (result.success) {
          this.visiteur = { nom: '', nombre_jours: 0, tarif_journalier: 0 };
          this.erreurs = { nom: '', jours: '', tarif: '' };
        }
      } catch (error) {
        this.message = 'Erreur lors de la communication avec le serveur';
        this.success = false;
      }
    }
  }
}
</script>

<style scoped>
.ajout-container {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
}

form {
  display: flex;
  flex-direction: column;
}
.form-group {
  margin-bottom: 15px;
}
.form-group label {
  display: block;
  margin-bottom: 5px;
}
.form-group input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
  border: 1px solid rgb(0, 0, 0, .3);
  border-radius: 5px;
  transition: .3s;
}
.form-group input:hover {
  border: 1px solid rgb(0, 0, 0, 1);
}
button {
  margin: 30px 0;
  width: 170px;
  justify-self: center;
  align-self: center;
  padding: 10px 15px;
  background: #42b983;
  color: white;
  border: 1px solid transparent;
  border-radius: 8px;
  cursor: pointer;
  transition: .3s;
}
button:hover {
  border: 1px solid #42b983;
  background: transparent;
  color: #42b983;
}
.message {
  margin-top: 15px;
  padding: 10px;
}
.success {
  background-color: #dff0d8;
  color: #3c763d;
}
.error {
  background-color: #f2dede;
  color: #a94442;
}
span {
  color:  red;
}
</style>