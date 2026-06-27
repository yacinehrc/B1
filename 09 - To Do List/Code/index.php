<?php
require_once "fonctions.php";
$view = (isset($_GET['view']) && $_GET['view'] == 'done') ? 1 : 0; // Si l'url contient '?view=done', alors $view = 1 (tâches terminées), sinon $view = 0 (tâches en cours)
$taches = getTasks($view); // Récupération des tâches et les mettre soit dans 'en cours' soit dans 'terminées' selon le statut grâce à la fonction 'getTasks' de 'fonctions.php'
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ToDo Desk</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="app">
        <aside class="sidebar">
            <h1 style="margin-bottom:40px; font-size: 1.5rem;margin:20,5,20,5;">TO DO LIST</h1>
            <nav>
                <a href="index.php" class="nav-link <?= $view == 0 ? 'active' : '' ?>">
                    <span><i class="fa-solid fa-list-ul"></i> En cours</span>
                    <small><?= countTasks(0) ?></small>
                </a>
                <br> <!-- Les countTasks(0) ↑ et countTasks(1) ↓ appellent la fonction 'countTasks' de 'fonctions.php' pour afficher le nombre de tâches dans chaque catégorie -->
                <a href="index.php?view=done" class="nav-link <?= $view == 1 ? 'active' : '' ?>">
                    <span><i class="fa-solid fa-circle-check"></i> Terminées</span>
                    <small><?= countTasks(1) ?></small>
                </a>
            </nav>
            <a href="ajouter.php" class="btn-add"><i class="fa-solid fa-plus"></i> Nouvelle tâche</a>
            <button id="theme-btn" class="theme-toggle">
                <i id="theme-icon" class="fa-solid fa-sun"></i> <span id="theme-text">Mode Clair</span>
            </button>
        </aside>

        <main class="main">
    <h2><?= $view == 1 ? 'Tâches terminées' : 'Planning actuel' ?></h2><br>
    
    <?php if (mysqli_num_rows($taches) > 0): ?> <!-- Vérification s'il y a au moins une tâche dans la catégorie sélectionnée, sinon message  "Aucunes tâches ne sont en cours/terminées" -->
        <?php while($t = mysqli_fetch_assoc($taches)): ?> <!-- Tant qu'il y a des tâches dans le return de la requête, alors éxécuter le code en-dessous -->
            <div class="task-item">
                <a href="valider.php?id=<?= $t['id'] ?>&statut=<?= $view == 0 ? 1 : 0 ?>" class="checkbox"> <!-- Lien vers 'valider.php' avec l'id de la tâche et le statut opposé (0 -> 1 ou 1 -> 0) -->
                    <i class="<?= $view == 1 ? 'fa-solid fa-circle-check' : 'fa-regular fa-circle' ?>"></i>
                </a>

                <div style="flex:1">
                    <div style="<?= $view == 1 ? 'text-decoration:line-through; opacity:0.4' : '' ?>"> <!-- Si la tâche est terminée, barrer le texte et diminuer l'opacité -->
                        <strong><?= htmlspecialchars($t['titre']) ?></strong>
                    </div>
                    <small style="color:var(--text-dim)"><?= htmlspecialchars($t['description']) ?></small>
                </div>

                <div style="display:flex; gap:15px;">
                    <a href="modifier.php?id=<?= $t['id'] ?>" style="color:var(--text-dim)" title="Modifier">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="supprimer.php?id=<?= $t['id'] ?>" style="color:#ef4444" title="Supprimer">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
    <div style="text-align: center; padding: 60px; color: var(--text-dim);">
        <i class="fa-regular fa-folder-open" style="font-size: 3.5rem; margin-bottom: 20px; display: block; opacity: 0.3;"></i>
        <p style="font-size: 1.1rem;">
            <?= $view == 1 ? "Aucune tâche terminée pour le moment." : "Aucune tâche en cours." ?>
        </p>
    </div>
<?php endif; ?>
</main>
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