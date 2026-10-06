<?php
$host = ""; // Adresse du serveur de base de données
$user = ""; // Admin de la BDD
$password = ""; // Mdp  de la BDD
$dbname = ""; // Nom de la base de données
$conn = mysqli_connect($host, $user, $password, $dbname); // Connexion à la BDD avec les informations précédentes
if (!$conn) { die("Connexion échouée : " . mysqli_connect_error()); } // Si la connexion échoue, affiche un message d'erreur
?>
