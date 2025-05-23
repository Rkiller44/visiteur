<template>
  <div class="top">
    <h1>GESTION DES VISITEURS</h1>
  </div>
  <div id="app">
    <router-view/>
  </div>
</template>
  

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
body {
  width: 100vw;
}
.top {
  background: grey;
  color: white;
  height: 50px;
  width: 100%;
  display: flex;
  justify-content: center;
  align-content: center;
}
</style>

