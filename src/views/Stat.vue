<template>
  <div class="stat-container">
    <h2>Statistiques</h2>
    <div v-if="stats">
      <div class="stats-grid">
        <div class="stat-card">
          <h3>Total</h3>
          <p>{{ stats.total }} AR</p>
        </div>
        <div class="stat-card">
          <h3>Minimal</h3>
          <p>{{ stats.minimal }} AR</p>
        </div>
        <div class="stat-card">
          <h3>Maximal</h3>
          <p>{{ stats.maximal }} AR</p>
        </div>
        <div class="stat-card">
          <h3>Visiteurs</h3>
          <p>{{ stats.count }}</p>
        </div>
      </div>
      
      <div class="chart-container">
        <canvas ref="chart"></canvas>
      </div>
    </div>
  </div>
</template>

<script>
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

export default {
  data() {
    return {
      stats: null,
      chart: null
    }
  },
  async mounted() {
    await this.fetchStats();
    this.renderChart();
  },
  methods: {
    async fetchStats() {
      try {
        const response = await fetch('/api/api/stats.php');
        this.stats = await response.json();
      } catch (error) {
        console.error('Erreur:', error);
      }
    },
    renderChart() {
      if (this.chart) {
        this.chart.destroy();
      }
      
      const ctx = this.$refs.chart.getContext('2d');
      this.chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Total', 'Minimal', 'Maximal'],
          datasets: [{
            label: 'Tarifs (Ariary)',
            data: [this.stats.total, this.stats.minimal, this.stats.maximal],
            backgroundColor: [
              'rgba(54, 162, 235, 0.5)',
              'rgba(75, 192, 192, 0.5)',
              'rgba(255, 99, 132, 0.5)'
            ],
            borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
  }
}
</script>

<style scoped>
.stat-container {
  padding: 20px;
}
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  margin-bottom: 30px;
}
.stat-card {
  background: #f8f9fa;
  border-radius: 8px;
  padding: 20px;
  text-align: center;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.stat-card h3 {
  margin-top: 0;
  color: #343a40;
}
.stat-card p {
  font-size: 1.5em;
  font-weight: bold;
  color: #42b983;
}
.chart-container {
  max-width: 800px;
  margin: 0 auto;
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>