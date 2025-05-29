<template>
  <div id="app">
    <nav>
      <router-link to="/ajout">Ajout</router-link> |
      <router-link to="/list">Liste</router-link> |
      <router-link to="/stat">Statistiques</router-link>
    </nav>
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
@font-face {
  font-family: Font;
  src: url(/src/assets/font/Poppins.ttf);
}
* {
  font-family: Font;
  padding: 0;
  margin: 0;
  list-style: none;
  text-decoration: none;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

nav {
  padding: 20px 0;
  text-align: center;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
  margin: 0 10px;
  text-decoration: none;
}

nav a.router-link-exact-active {
  color: #42b983;
}
h2 {
  font-size: 2em;
  margin-bottom: 30px;
}
button {
  border: none;
  background: transparent;
  margin-left: 20px;
  transition: .3s;
}
button:hover {
  fill: #42b983;
  transform: scale(1.1);
}
</style>