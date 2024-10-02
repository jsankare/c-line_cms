function changeTheme() {
    // Vérifie si la clé 'theme' est définie dans localStorage
    let currentTheme = localStorage.getItem('theme');

    // Si la clé 'theme' n'est pas définie ou est 'light', on la passe à 'dark'
    if (!currentTheme || currentTheme === 'light') {
        localStorage.setItem('theme', 'dark');
    } else {
        // Sinon, on la passe à 'light'
        localStorage.setItem('theme', 'light');
    }

    // Rafraîchir les styles après le changement de thème
    applyTheme();
}

// Fonction pour appliquer le thème en fonction de la clé dans localStorage
function applyTheme() {
    const theme = localStorage.getItem('theme');
    const mainElement = document.getElementById('main');
    const themeIcon = document.getElementById('themeIcon');

    if (theme === 'dark') {
        // Applique le style dark
        mainElement.style.backgroundColor = '#111621';
        mainElement.style.color = '#f9f9f9';
        // Change l'icône à l'icône du soleil
        themeIcon.src = '/assets/sun.svg';
    } else {
        // Applique le style light par défaut
        mainElement.style.backgroundColor = '#f9f9f9';
        mainElement.style.color = '#111621';
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