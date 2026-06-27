<?php
require_once "config.php"; // Connexion à la BDD
function getTasks($statut = 0) { // Création d'une machine 'getTasks' avec un paramètre $statut par défaut à 0 (tâches en cours)
    global $conn; // Utilisation de la variable globale $conn de 'config.php' (connexion à la BDD)
    $sql = "SELECT * FROM taches WHERE statut = $statut ORDER BY id DESC"; // Requête SQL pour récupérer les tâches selon leur statut
    return mysqli_query($conn, $sql); // Éxécution et retour des résultats de la requête
}
function getTaskById($id) { // Création d'une machine 'getTaskById' qui prend un paramètre $id
    global $conn; 
    $id = (int)$id; // Id est focément un entier pour éviter les injections SQL
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM taches WHERE id = $id")); // Récupère une seule tâche avec l'id donné et retourne un tableau associatif
}
function countTasks($statut) { // Création d'une machine 'countTasks' qui compte les tâches 'en cours' ou 'terminées'
    global $conn;
    $res = mysqli_query($conn, "SELECT COUNT(*) as total FROM taches WHERE statut = $statut"); // Requête SQL pour compter les tâches correspondant à leur statut
    $data = mysqli_fetch_assoc($res); // Récupère le résultat
    return $data['total']; // Retourne le nombre total de tâches dans la sidebar de 'index.php'
} 
?>