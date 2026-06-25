<?php
require_once "fonctions.php";
$id = (int)$_GET['id']; // Récupération de l'id et conversion en entier
$tache = getTaskById($id); // Appelation de la fonction crée dans 'fonctions.php' pour récupérer la tâche correspondante

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Si le formulaire est soumis
    $titre = mysqli_real_escape_string($conn, $_POST['titre']); // Mettre à jour la table 'tâches', changer le titre et la description QUE pour cette ligne
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    mysqli_query($conn, "UPDATE taches SET titre = '$titre', description = '$description' WHERE id = $id");
    $view = $tache['statut'] == 1 ? '?view=done' : ''; // Si la tâche est terminée, préparation d'un texte de redirection vers les tâches 'terminées'
header("Location: index.php" . $view); // Redirection vers la page principale
exit;

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body style="align-items: center;">
    <div class="app" style="display:block; max-width:600px; padding:40px; height: fit-content;">
        <h1><i class="fa-solid fa-pen-to-square"></i> Modifier la tâche</h1><br>
        <form method="POST">
            <div class="form-group">
                <label>Titre</label>
                <input type="text" name="titre" value="<?= htmlspecialchars($tache['titre']) ?>" required> <!-- Demande à PHP d'écrire titre + description dans la case de texte -->
            </div>                                       <!--    ↓   Si le titre contient des caractères spéciaux, les convertir en entités HTML pour éviter les problèmes d'affichage -->
            <br>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description"><?= htmlspecialchars($tache['description']) ?></textarea>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn-add"><i class="fa-solid fa-floppy-disk"></i> Enregistrer les modifications</button>
                <a href="index.php" class="btn-cancel"><i class="fa-solid fa-xmark"></i> Annuler</a>
            </div>
        </form>
    </div>
    <script>
    const html = document.documentElement;
    const themeBtn = document.getElementById("theme-btn");
    const themeText = document.getElementById("theme-text");
    const themeIcon = document.getElementById("theme-icon");

    const savedTheme = localStorage.getItem("theme") || "dark";
    html.setAttribute("data-theme", savedTheme);

    function updateButtonUI(theme) {
        if (!themeBtn) return; 
        if (theme === "light") {
            themeText.innerText = "Mode Sombre";
            themeIcon.className = "fa-solid fa-moon";
        } else {
            themeText.innerText = "Mode Clair";
            themeIcon.className = "fa-solid fa-sun";
        }
    }

    updateButtonUI(savedTheme);

    if (themeBtn) {
        themeBtn.addEventListener("click", () => {
            const currentTheme = html.getAttribute("data-theme");
            const newTheme = currentTheme === "light" ? "dark" : "light";
            
            html.setAttribute("data-theme", newTheme);
            localStorage.setItem("theme", newTheme);
            updateButtonUI(newTheme);
        });
    }
</script>
</body>
</html>