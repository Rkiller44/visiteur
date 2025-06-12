<template>
  <div class="ajout-container">
    <h2>Ajout d'un visiteur</h2>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label>Nom :</label>
         <input 
          v-model.trim="visiteur.nom" 
          @input="validerNom"
          @blur="validerNom"
          :class="{ 'input-error': erreurs.nom }"
        >
        <span class="error-message" v-if="erreurs.nom">{{ erreurs.nom }}</span>
      </div>
      <div class="form-group">
        <label>Nombre de jours :</label>
        <input 
          v-model.number="visiteur.nombre_jours" 
          type="number" 
          @input="validerJours"
          @blur="validerJours"
          :class="{ 'input-error': erreurs.jours }"
          placeholder="1"
        >
        <span class="error-message" v-if="erreurs.jours">{{ erreurs.jours }}</span>
      </div>
      <div class="form-group">
        <label>Tarif journalier (en Ar):</label>
        <input 
          v-model.number="visiteur.tarif_journalier" 
          type="number" 
          step="1"
          @input="validerTarif"
          @blur="validerTarif"
          :class="{ 'input-error': erreurs.tarif }"
          placeholder="1"
        >
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
        nom: '',
        jours: '',
        tarif: ''
      },
      message: '',
      success: false
    }
  },

  computed: {
    formulaireValide() {
      return !this.erreurs.nom && 
             !this.erreurs.jours && 
             !this.erreurs.tarif &&
             this.visiteur.nom !== '' &&
             this.visiteur.nombre_jours > 0 &&
             this.visiteur.tarif_journalier > 0;
    }
  },

  mounted() {
    // Validation initiale des champs
    this.validerNom();
    this.validerJours();
    this.validerTarif();
  },

  methods: {

      validerNom() {
      if (!this.visiteur.nom.trim()) {
        this.erreurs.nom = 'Le nom est obligatoire';
        return false;
      }
      if (this.visiteur.nom.length < 2) {
        this.erreurs.nom = 'Le nom doit contenir au moins 2 caractères';
        return false;
      }
      this.erreurs.nom = '';
      return true;
    },

    validerJours() {
      const valeur = Number(this.visiteur.nombre_jours);
      if (isNaN(valeur)) {
        this.erreurs.jours = 'Veuillez entrer un nombre valide';
        return false;
      }
      if (valeur <= 0) {
        this.erreurs.jours = 'Doit être supérieur à 0';
        return false;
      }
      if (!Number.isInteger(valeur)) {
        this.erreurs.jours = 'Doit être un nombre entier';
        return false;
      }
      this.erreurs.jours = '';
      return true;
    },

    validerTarif() {
      const valeur = Number(this.visiteur.tarif_journalier);
      if (isNaN(valeur)) {
        this.erreurs.tarif = 'Veuillez entrer un nombre valide';
        return false;
      }
      if (valeur <= 0) {
        this.erreurs.tarif = 'Doit être supérieur à 0';
        return false;
      }
      this.erreurs.tarif = '';
      return true;
    },

    async submitForm() {

      const nomValide = this.validerNom();
      const joursValide = this.validerJours();
      const tarifValide = this.validerTarif();

      if (!nomValide || !joursValide || !tarifValide) {
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
          // Réinitialiser le formulaire après succès
          this.visiteur = { nom: '', nombre_jours: 0, tarif_journalier: 0 };
          this.erreurs = { nom: '', jours: '', tarif: '' };
        }
      } catch (error) {
        this.message = 'Erreur lors de la communication avec le serveur';
        this.success = false;
        console.error('Erreur:', error);
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