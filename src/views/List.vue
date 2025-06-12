<template>
  <div class="list-container">
    <h2>Liste des visiteurs</h2>
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Jours</th>
          <th>Tarif/jour</th>
          <th>Total</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="visiteur in visiteurs" :key="visiteur.id">
          <td v-if="!visiteur.editing">{{ visiteur.nom }}</td>
          <td v-else>
            <input 
            v-model.trim="visiteur.nom" 
            @input="validateNom(visiteur)"
            @blur="validateNom(visiteur)"
            :class="{ 'input-error': visiteur.errors.nom }"
            ><br>
            <span class="error-message" v-if="visiteur.errors.nom">{{ visiteur.errors.nom }}</span>
          </td>
          <td v-if="!visiteur.editing">{{ visiteur.nombre_jours }}</td>
            <td v-else>
            <input 
              v-model.number="visiteur.nombre_jours" 
              type="number" 
              min="1"
              @input="validateJours(visiteur)"
              @blur="validateJours(visiteur)"
              :class="{ 'input-error': visiteur.errors.jours }"
            ><br>
            <span class="error-message" v-if="visiteur.errors.jours">{{ visiteur.errors.jours }}</span>
          </td>
          
          <td v-if="!visiteur.editing">{{ visiteur.tarif_journalier }}</td>
               <td v-else>
            <input 
              v-model.number="visiteur.tarif_journalier" 
              type="number" 
              min="1"
              step="1000"
              @input="validateTarif(visiteur)"
              @blur="validateTarif(visiteur)"
              :class="{ 'input-error': visiteur.errors.tarif }"
            ><br>
            <span class="error-message" v-if="visiteur.errors.tarif">{{ visiteur.errors.tarif }}</span>
          </td>
          
          <td>{{ visiteur.tarif }}</td>
          
          <td>
            <button v-if="!visiteur.editing" @click="visiteur.editing = true">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"/><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"/></svg>  
            </button>
            <button v-else @click="updateVisiteur(visiteur)">
              <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" transform="" id="injected-svg"><!--Boxicons v3.0 https://boxicons.com | License  https://docs.boxicons.com/free--><path d="M5 21h14c1.1 0 2-.9 2-2V8c0-.27-.11-.52-.29-.71l-4-4A1 1 0 0 0 16 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2m10-2H9v-5h6zM11 5h2v2h-2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v5H5z"></path></svg>
            </button>
            <button @click="deleteVisiteur(visiteur.id)">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z"/></svg>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-if="message" :class="['message', success ? 'success' : 'error']">
      {{ message }}
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      visiteurs: [],
      message: '',
      success: false
    }
  },
  async created() {
    await this.fetchVisiteurs();
  },
  methods: {

  
    async fetchVisiteurs() {
      try {
        const response = await fetch('/api/api/visiteurs.php');
        this.visiteurs = (await response.json()).map(v => ({ 
          ...v, 
          editing: false,
            errors: {
            nom: '',
            jours: '',
            tarif: ''
            }
        }));
      } catch (error) {
        console.error('Erreur:', error);
        this.message = 'Erreur lors du chargement des visiteurs';
        this.success = false;
      }
    },

     toggleEdit(visiteur) {
      visiteur.editing = !visiteur.editing;
      if (!visiteur.editing) {
        visiteur.errors = { nom: '', jours: '', tarif: '' };
      }
    },
    
    validateNom(visiteur) {
      if (!visiteur.nom.trim()) {
        visiteur.errors.nom = 'Le nom est obligatoire';
        return false;
      }
      if (visiteur.nom.length < 2) {
        visiteur.errors.nom = 'Le nom doit contenir au moins 2 caractères';
        return false;
      }
      visiteur.errors.nom = '';
      return true;
    },

    validateJours(visiteur) {
      const valeur = Number(visiteur.nombre_jours);
      if (isNaN(valeur)) {
        visiteur.errors.jours = 'Veuillez entrer un nombre valide';
        return false;
      }
      if (valeur <= 0) {
        visiteur.errors.jours = 'Doit être supérieur à 0';
        return false;
      }
      if (!Number.isInteger(valeur)) {
        visiteur.errors.jours = 'Doit être un nombre entier';
        return false;
      }
      visiteur.errors.jours = '';
      return true;
    },

    validateTarif(visiteur) {
      const valeur = Number(visiteur.tarif_journalier);
      if (isNaN(valeur)) {
        visiteur.errors.tarif = 'Veuillez entrer un nombre valide';
        return false;
      }
      if (valeur <= 0) {
        visiteur.errors.tarif = 'Doit être supérieur à 0';
        return false;
      }
      visiteur.errors.tarif = '';
      return true;
    },

     isVisiteurValid(visiteur) {
      return !visiteur.errors.nom && 
             !visiteur.errors.jours && 
             !visiteur.errors.tarif &&
             visiteur.nom.trim() !== '' &&
             visiteur.nombre_jours > 0 &&
             visiteur.tarif_journalier > 0;
    },

    async updateVisiteur(visiteur) {
      const nomValide = this.validateNom(visiteur);
      const joursValide = this.validateJours(visiteur);
      const tarifValide = this.validateTarif(visiteur);
      
      if (!nomValide || !joursValide || !tarifValide) {
        this.message = 'Veuillez corriger les erreurs avant de sauvegarder';
        this.success = false;
        return;
      }
      
      try {
        const response = await fetch(`/api/api/visiteurs.php?id=${visiteur.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `id=${visiteur.id}&nom=${encodeURIComponent(visiteur.nom)}&nombre_jours=${visiteur.nombre_jours}&tarif_journalier=${visiteur.tarif_journalier}`
        });
        
        const result = await response.json();
        this.message = result.message;
        this.success = result.success;
        
        if (result.success) {
          visiteur.editing = false;
          await this.fetchVisiteurs();
        }
      } catch (error) {
        this.message = 'Erreur lors de la modification';
        this.success = false;
      }
    },
    async deleteVisiteur(id) {
      if (confirm('Êtes-vous sûr de vouloir supprimer ce visiteur ?')) {
        try {
          const response = await fetch(`/api/api/visiteurs.php?id=${id}`, {
            method: 'DELETE'
          });
          
          const result = await response.json();
          this.message = result.message;
          this.success = result.success;
          
          if (result.success) {
            await this.fetchVisiteurs();
          }
        } catch (error) {
          this.message = 'Erreur lors de la suppression';
          this.success = false;
        }
      }
    }
  }
}
</script>

<style scoped>
.list-container {
  padding: 20px;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}
th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
}
th {
  background-color: #f2f2f2;
}
button {
  margin: 0 3px;
  cursor: pointer;
}
input {
  width: 80px;
  padding: 5px;
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
.input-error {
  border-color: #ff4444;
}

.error-message {
  color: #ff4444;
  font-size: 0.8em;
  display: block;
  margin-top: 5px;
}
</style>