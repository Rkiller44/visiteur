<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "base_VueJS"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Echec de la connexion: " . mysqli_connect_error());
}
?>