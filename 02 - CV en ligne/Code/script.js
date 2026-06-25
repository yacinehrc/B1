document.addEventListener('DOMContentLoaded', () => {

    /**
     * Applique le thème spécifié à la page et met à jour l'état actif des pastilles.
     * @param {string} theme - Le nom du thème à appliquer (ex: 'noir', 'bleu').
     */
    function applyTheme(theme) {
        // 1. Appliquer le thème à la balise <html>
        document.documentElement.setAttribute('data-theme', theme);

        // 2. Mettre à jour l'état visuel actif de la pastille
        document.querySelectorAll('.theme-option').forEach(option => {
            // Retire la classe 'active' de toutes les pastilles
            option.classList.remove('active');

            // Ajoute la classe 'active' à la pastille correspondant au thème actuel
            if (option.getAttribute('data-theme-value') === theme) {
                option.classList.add('active');
            }
        });
    }

    // --- LOGIQUE D'INITIALISATION ---

    const savedTheme = localStorage.getItem('userTheme');

    // Trouver le thème par défaut s'il n'y a rien dans le localStorage
    // Utilise 'blanc' comme valeur de repli si data-theme n'est pas défini au départ
    const defaultTheme = document.documentElement.getAttribute('data-theme') || 'blanc';

    if (savedTheme) {
        // Appliquer le thème sauvegardé
        applyTheme(savedTheme);
    } else {
        // Appliquer le thème par défaut (souvent 'blanc')
        applyTheme(defaultTheme);
    }

    // --- ÉCOUTEURS D'ÉVÉNEMENTS (Rend les boutons cliquables) ---

    document.querySelectorAll('.theme-option').forEach(option => {
        option.addEventListener('click', () => {
            const theme = option.getAttribute('data-theme-value');

            // Appliquer et sauvegarder le nouveau thème
            applyTheme(theme);
            localStorage.setItem('userTheme', theme);
        });
    });
});
