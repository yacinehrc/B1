<?php
$host = "sql113.infinityfree.com"; // Adresse du serveur de base de données
$user = "if0_41051738"; // Admin de la BDD
$password = "64DdaZ06j2C2kf"; // Mdp  de la BDD
$dbname = "if0_41051738_todo_list"; // Nom de la base de données
$conn = mysqli_connect($host, $user, $password, $dbname); // Connexion à la BDD avec les informations précédentes
if (!$conn) { die("Connexion échouée : " . mysqli_connect_error()); } // Si la connexion échoue, affiche un message d'erreur
?>