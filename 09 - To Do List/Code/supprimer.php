<?php
require_once "fonctions.php";
$id = (int)$_GET['id']; // Récupération de l'id de la tâche à supprimer
$tache = getTaskById($id); // Récupération des informations de la tâche correspondante pour l'affocher dans le message de confirmation de la suppression

if (isset($_POST['confirm'])) { // Suppresion seulement si l'utilisateur a cliqué sur le bouton de confirmation
    mysqli_query($conn, "DELETE FROM taches WHERE id = $id"); // Suppression de la ligne dans la BDD
    header("Location: index.php"); exit; // Une fois la tâche supprimée, redirection vers la page principale
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
    <div class="app" style="display:block; max-width:500px; padding:40px; text-align: center; height: fit-content;">
        <i class="fa-solid fa-trash-can" style="font-size: 3rem; color: #ef4444; margin-bottom: 20px;"></i>
        <h2>Supprimer la tâche ?</h2><br>
        <p>Voulez-vous vraiment supprimer "<strong><?= htmlspecialchars($tache['titre']) ?></strong>" ?</p>
        <form method="POST">
            <div class="btn-container">
                <button type="submit" name="confirm" class="btn-add btn-danger">
    Confirmer la suppression
</button>

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