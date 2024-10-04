const slider = document.querySelector('.reviews--slider');
const previousButton = document.querySelector('.reviews--nav.previous');
const nextButton = document.querySelector('.reviews--nav.next');
const reviewContainer = document.querySelector('.reviews--container');

let currentIndex = 0;
const totalReviews = document.querySelectorAll('.review').length;
let reviewsPerPage = 3; // Par défaut, on affiche 3 avis

// Met à jour le slider pour afficher les avis en fonction de l'index
function updateSlider() {
    const offset = -currentIndex * (100 / reviewsPerPage);
    slider.style.transform = `translateX(${offset}%)`;
}

// Gère la classe responsive selon la taille de l'écran
function checkScreenSize() {
    if (window.innerWidth < 768) {
        reviewContainer.classList.add('single-review'); // Ajoute la classe pour un seul avis
        reviewsPerPage = 1;
    } else {
        reviewContainer.classList.remove('single-review'); // Supprime la classe, revient à 3 avis
        reviewsPerPage = 3;
    }
    updateSlider();
}

// Navigation des avis précédents
previousButton.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = Math.ceil(totalReviews / reviewsPerPage) - 1; // Retour à la dernière page
    }
    updateSlider();
});

// Navigation des avis suivants
nextButton.addEventListener('click', () => {
    if (currentIndex < Math.ceil(totalReviews / reviewsPerPage) - 1) {
        currentIndex++;
    } else {
        currentIndex = 0; // Retour au début si plus d'avis
    }
    updateSlider();
});

// Détection du scroll horizontal pour la navigation
document.addEventListener('wheel', (event) => {
    if (event.deltaX > 0) {
        // Scroll vers la droite
        if (currentIndex < Math.ceil(totalReviews / reviewsPerPage) - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // Reviens au début
        }
    } else if (event.deltaX < 0) {
        // Scroll vers la gauche
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = Math.ceil(totalReviews / reviewsPerPage) - 1; // Reviens à la fin
        }
    }
    updateSlider();
});

// Surveille les changements de taille d'écran et adapte le nombre d'avis visibles
window.addEventListener('resize', checkScreenSize);
checkScreenSize(); // Appelle la fonction au chargement de la page
