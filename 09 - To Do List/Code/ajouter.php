<?php
require_once "fonctions.php"; // Recherche le fichier 'fonctions.php' pour inclure les fonctions nécessaires
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Si l'utilisateur a soumis le formulaire, fait ce qui suit
    $titre = mysqli_real_escape_string($conn, $_POST['titre']); // Nettoyer le titre pour éviter le cassage de la BDD
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    if ($titre !== "") { // Si le titre est vide, n'ajoute pas la tâche
        mysqli_query($conn, "INSERT INTO taches (titre, description) VALUES ('$titre', '$description')"); // Envoie les donnéees à la BDD et crée une nouvelle ligne
        header("Location: index.php"); exit; // Redirige vers la page principale après l'ajout
    }
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
        <h1><i class="fa-solid fa-plus-circle"></i> Nouvelle tâche</h1><br>
        <form method="POST">
            <div class="form-group">
                <label>Titre *</label>
                <input type="text" name="titre" placeholder="Faire mes devoirs..." required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Détails de la tâche..."></textarea>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn-add"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
                <a href="index.php" class="btn-cancel"><i class="fa-solid fa-xmark"></i> Annuler</a>
            </div>
        </form>
    </div>
    <script> // Script pour gérer le thème clair/sombre
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