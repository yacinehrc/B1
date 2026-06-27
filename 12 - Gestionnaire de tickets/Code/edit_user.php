<?php
// Démarrage de la session pour suivre l'utilisateur connecté
session_start();
// Inclusion de la connexion à la base de données
include('config.php');

/**
 * 1. Sécurité : contrôle d'accès
 * On vérifie que la personne est connectée et qu'elle a le rôle administrateur.
 * Sinon, redirection immédiate vers la page de connexion.
 */
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { 
    header('Location: login.php'); 
    exit(); 
}

// Initialisation des variables pour afficher des retours à l'utilisateur
$message = "";
$error = "";

/**
 * 2. Récupération de l'utilisateur à modifier
 * On récupère l'identifiant (ID) passé dans l'adresse URL (ex: edit_user.php?id=5).
 */
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Recherche des informations de cet utilisateur précis
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id_u = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    // Si l'utilisateur n'existe pas dans la base, on retourne à la liste
    if(!$user) {
        header('Location: admin_user.php');
        exit();
    }
} else {
    // Si aucun ID n'est fourni, on retourne à la liste
    header('Location: admin_user.php');
    exit();
}

/**
 * 3. Traitement du formulaire de mise à jour
 * Ce bloc s'exécute quand l'administrateur clique sur le bouton de sauvegarde.
 */
if(isset($_POST['update_user'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $new_pass = $_POST['new_password'];

    try {
        // Cas 1 : Un nouveau mot de passe a été saisi
        if(!empty($new_pass)) {
            $pass_hash = md5($new_pass); // Hachage du nouveau mot de passe
            $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, email = ?, password = ?, role = ? WHERE id_u = ?");
            $stmt->execute([$nom, $email, $pass_hash, $role, $id]);
        } 
        // Cas 2 : Le mot de passe reste inchangé
        else {
            $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, email = ?, role = ? WHERE id_u = ?");
            $stmt->execute([$nom, $email, $role, $id]);
        }
        
        $message = "Profil mis à jour avec succès.";
        
        // On recharge les données de l'utilisateur pour afficher les nouvelles valeurs dans le formulaire
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id_u = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        
    } catch(Exception $e) {
        $error = "Erreur lors de la mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier l'utilisateur</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="atelierlogo.png">
    <style>
        body { font-family: "Raleway", sans-serif; font-size: 16px; }
        .w3-sidebar { z-index: 5; width: 300px; height: 100%; position: fixed; }
        
        /* Configuration de l'en-tête mobile */
        .top-header { 
            display: none; position: fixed; top: 0; left: 0; right: 0; 
            width: 100%; z-index: 4; height: 50px; padding: 0; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); align-items: center; 
            background: #333 !important; color: white;
        }
        .top-header .header-title { flex: 1; text-align: right; font-weight: bold; font-size: 1.1em; padding-right: 15px; }

        /* Styles pour tablettes et téléphones */
        @media screen and (max-width: 768px) {
            .top-header { display: flex !important; }
            .w3-main { margin-left: 0 !important; margin-top: 50px !important; padding-top: 10px; }
            .w3-sidebar { width: 260px !important; display: none; position: fixed !important; box-shadow: 4px 0 10px rgba(0,0,0,0.3); }
            .w3-sidebar.w3-show { display: block !important; }
        }

        /* Styles pour ordinateurs */
        @media (min-width: 769px) {
            .w3-main { margin-left: 300px !important; }
            .w3-sidebar { display: block !important; }
        }
    </style>
</head>
<body class="w3-light-grey">

<nav class="w3-sidebar w3-collapse w3-white w3-card w3-animate-left" id="mySidebar">
  <div class="w3-container w3-padding-16 w3-blue"><h5><b>L'Atelier des Jeux</b></h5></div>
  <div class="w3-container w3-padding-16">
    <h5>Bienvenue, <b><?php echo htmlspecialchars($_SESSION['nom']); ?></b></h5>
    <span class="w3-tag w3-blue w3-round">Administrateur</span>
  </div>
  <hr>
  <div class="w3-bar-block">
    <a href="admin_dashboard.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
    <a href="admin_user.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i> Gestion Comptes</a>
    <a href="log_view.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i> Logs Connexions</a>
    <a href="profil.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i> Paramètres</a>
  </div>
</nav>

<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<div class="top-header w3-bar w3-top">
  <button class="w3-button w3-hover-none" onclick="w3_open();" style="font-size:1.5em; padding:0 15px;">☰</button>
  <div class="header-title">Modifier</div>
</div>

<div class="w3-main">
    <div class="w3-container" style="padding-top:22px">
        <h3 class="w3-left-align"><b><i class="fa fa-pencil"></i> Modifier l'utilisateur</b></h3>

        <?php if($message): ?>
            <div class="w3-panel w3-blue w3-round w3-card w3-display-container">
                <span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <p><?= $message ?></p>
            </div>
        <?php endif; ?>

        <div class="w3-card w3-white w3-round w3-margin-bottom">
            <header class="w3-container w3-light-grey">
                <h4 class="w3-opacity">Informations de <?= htmlspecialchars($user['nom']) ?></h4>
            </header>
            
            <form method="POST" class="w3-container w3-padding-16">
                <div class="w3-section">
                    <label><b>Nom complet</b></label>
                    <input class="w3-input w3-border w3-round w3-light-grey" type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
                </div>

                <div class="w3-section">
                    <label><b>Email</b></label>
                    <input class="w3-input w3-border w3-round w3-light-grey" type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <div class="w3-section">
                    <label><b>Rôle</b></label>
                    <select class="w3-select w3-border w3-round w3-light-grey" name="role">
                        <option value="utilisateur" <?= ($user['role'] == 'utilisateur') ? 'selected' : '' ?>>Utilisateur</option>
                        <option value="technicien" <?= ($user['role'] == 'technicien') ? 'selected' : '' ?>>Technicien</option>
                        <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Administrateur</option>
                    </select>
                </div>

                <div class="w3-section">
                    <label><b>Nouveau mot de passe</b></label>
                    <input class="w3-input w3-border w3-round w3-light-grey" type="password" name="new_password" placeholder="Laisser vide pour ne pas changer">
                </div>

                <div class="w3-padding-16">
                    <button class="w3-button w3-blue w3-round w3-block" name="update_user">
                        <i class="fa fa-save"></i> Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>

        <a href="admin_user.php" class="w3-button w3-light-grey w3-round w3-border">
            <i class="fa fa-arrow-left"></i> Retour à la gestion des utilisateurs
        </a>
    </div>
</div>

<script>
var mySidebar = document.getElementById("mySidebar");
var overlayBg = document.getElementById("myOverlay");

function w3_open() {
    if (mySidebar.className.indexOf("w3-show") == -1) {
        mySidebar.classList.add('w3-show');
        overlayBg.style.display = "block";
    }
}

function w3_close() {
    mySidebar.classList.remove('w3-show');
    overlayBg.style.display = "none";
}
</script>

</body>
</html>