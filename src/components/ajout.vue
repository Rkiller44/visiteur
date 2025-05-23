<template>
    <!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>Ajouter un visiteur</title>
</head>

<body>
    <div class="form-container">
        
  <form class="form-container" action="#" method="post">
    <h1>Ajouter un visiteur:</h1>

    <label for="numero">n°visiteur:</label>
    <input type="number" id="numero" name="numero">

    <label for="nom">nom:</label>
    <input type="text" id="nom" name="nom">

    <label for="jours">nombre de jours:</label>
    <input type="number" id="jours" name="jours">

    <label for="tarif">Tarif journalier:</label>
    <input type="number" id="tarif" name="tarif">

    <div class="button-container">
       <input type="submit" value="Ajouter" name="button">
    </div>
  </form>
    </div>
</body>
</html>

</template>