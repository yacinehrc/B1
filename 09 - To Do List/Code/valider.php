<?php
require_once "config.php"; // Connexion à la BDD
$id = (int)$_GET['id']; // Récupération de l'id de la tâche et conversion en entier
$statut = (int)$_GET['statut']; // Récupération du nouveau statut envoyé (0 ou 1) et conversion en entier
mysqli_query($conn, "UPDATE taches SET statut = $statut WHERE id = $id"); // Mettre à jour le statut de la tâche correspondante dans la BDD
header("Location: index.php" . ($statut == 1 ? "?view=done" : "")); // Si le nouveau statut est 1 (terminée), rediriger vers les tâches terminées, sinon vers les tâches en cours
exit; // Terminer le script pour éviter toute exécution supplémentaire
?>