<?php
    
// Configuration de l'affichage des erreurs (utile pour le développement/débogage)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarrage de la session pour stocker les informations de l'utilisateur connecté (ID, rôle, nom)
session_start();

// Inclusion du fichier de configuration pour établir la connexion à la base de données via l'objet $pdo
include('config.php');

// Initialisation d'une variable vide pour stocker les messages d'erreur à afficher à l'utilisateur
$error = "";

// Vérification si le formulaire a été soumis via le bouton nommé 'connexion'
if (isset($_POST['connexion'])) {
    
    // Nettoyage des données saisies : trim() enlève les espaces inutiles en début et fin de chaîne
    $nom = trim($_POST['username']); 
    
    // Hachage du mot de passe en MD5 pour correspondre au format stocké dans la base de données
    // Note : MD5 est utilisé ici par souci de simplicité, bien que password_hash() soit plus sécurisé
    $pass = md5($_POST['password']); 

    // Préparation de la requête SQL pour vérifier si le couple Nom / Mot de passe existe de façon sécurisée
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE nom = ? AND password = ?");
    $stmt->execute([$nom, $pass]);
    
    // Récupération des données de l'utilisateur sous forme de tableau associatif
    $user = $stmt->fetch();

    if ($user) {
        /** * GESTION DES RÈGLES MÉTIER ET SESSION
         */
        // On bloque l'accès si le compte est marqué comme 'inactif' (ex: suspension)
        if ($user['role'] == 'inactif') {
            $error = "Compte inactif (plus de 1 mois sans connexion).";
        } else {
            // Sécurité & Suivi : Mise à jour de la date 'derniere_connexion' en BDD à chaque succès
            $pdo->prepare("UPDATE utilisateurs SET derniere_connexion = NOW() WHERE id_u = ?")->execute([$user['id_u']]);
            
            // Stockage des informations clés en SESSION pour maintenir la connexion sur toutes les pages
            $_SESSION['user_id'] = $user['id_u']; // Identifiant unique en BDD
            $_SESSION['role'] = $user['role'];    // Rôle : admin, technicien ou utilisateur
            $_SESSION['nom'] = $user['nom'];      // Nom affiché dans l'interface
            
            // Redirection vers la page d'accueil (index) après une connexion réussie
            header('Location: index.php');
            exit();
        }
    } else {
        /**
         * BLOC DE DIAGNOSTIC (Debug)
         * Aide l'utilisateur à savoir si l'erreur vient du nom d'utilisateur ou du mot de passe
         */
        $check = $pdo->prepare("SELECT * FROM utilisateurs WHERE nom = ?");
        $check->execute([$nom]);
        if (!$check->fetch()) {
            $error = "L'utilisateur '$nom' n'existe pas dans la base.";
        } else {
            $error = "Mot de passe incorrect pour '$nom'.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion - L'Atelier des Jeux</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="icon" type="image/x-icon" href="atelierlogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body, h1, h2 { font-family: "Raleway", sans-serif; }
        
        /* Adaptations CSS spécifiques pour le Responsive (Smartphones et Tablettes) */
        @media screen and (max-width: 768px) {
            .w3-display-middle { padding: 10px; position: static !important; transform: none !important; margin: 20px auto; }
            .w3-card-4 { margin: 10px; }
            .w3-input, .w3-button { width: 100%; box-sizing: border-box; margin: 5px 0; }
            h3 { font-size: 1.4em; }
        }
    </style>
</head>
<body class="w3-dark-grey">
    <div class="w3-display-middle" style="width:100%; max-width:400px; padding:16px;">
        <div class="w3-card-4 w3-white w3-round-large">
            <div class="w3-container w3-blue w3-round-large w3-center">
                <h3>Atelier des Jeux - Support Service</h3>
                <p>Connectez-vous pour accéder à votre espace de support</p>
            </div>
            
            <form class="w3-container w3-padding-24" method="POST">
                <?php if($error) echo "<p class='w3-text-red w3-center'><b>$error</b></p>"; ?>
                
                <label>Nom d'utilisateur</label>
                <input class="w3-input w3-border w3-round" type="text" name="username" required>
                <br>
                
                <label>Mot de passe</label>
                <input class="w3-input w3-border w3-round" type="password" name="password" required>
                
                <button class="w3-button w3-block w3-blue w3-section w3-round" name="connexion">Se connecter</button>
                
                <p class="w3-center w3-small"><a href="register.php">Créer un compte</a></p>
            </form>
        </div>
    </div>
</body>
</html>