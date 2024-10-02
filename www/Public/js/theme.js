// Fonction pour inverser le thème et mettre à jour localStorage
function changeTheme() {
    let currentTheme = localStorage.getItem('theme');

    // Si la clé 'theme' n'est pas définie ou est 'light', on la passe à 'dark'
    if (!currentTheme || currentTheme === 'light') {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }

    // Applique le nouveau thème
    applyTheme();
}

// Fonction pour appliquer le thème en fonction de la clé dans localStorage
function applyTheme() {
    const theme = localStorage.getItem('theme');
    const actionElement = document.getElementById('theme');
    const mainElement = document.getElementById('main');
    const themeIcon = document.getElementById('themeIcon');

    if (theme === 'dark') {
        // Applique la classe dark-theme
        mainElement.classList.remove('light-theme');
        mainElement.classList.add('dark-theme');
        actionElement.classList.add('light-theme');
        actionElement.classList.remove('dark-theme');
        // Change l'icône à l'icône du soleil
        themeIcon.src = '/assets/sun.svg';
    } else {
        // Applique la classe light-theme
        mainElement.classList.remove('dark-theme');
        mainElement.classList.add('light-theme');
        actionElement.classList.add('dark-theme');
        mainElement.classList.remove('light-theme');
        // Change l'icône à l'icône de la lune
        themeIcon.src = '/assets/moon.svg';
    }
}

// Applique le thème lors du chargement de la page
applyTheme();

// Écouteur d'événement pour le clic sur le lien de changement de thème
document.getElementById('themelink').addEventListener('click', function(e) {
    e.preventDefault(); // Empêche le comportement par défaut du lien
    changeTheme(); // Change le thème lors du clic
});
