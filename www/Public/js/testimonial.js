const slider = document.querySelector('.reviews--slider');
const previousButton = document.querySelector('.reviews--nav.previous');
const nextButton = document.querySelector('.reviews--nav.next');

let currentIndex = 0;
const totalReviews = document.querySelectorAll('.review').length;
const reviewsPerPage = 3;
const totalPages = Math.ceil(totalReviews / reviewsPerPage);

// Update pour montrer les avis de l'index actuel
function updateSlider() {
    const offset = -currentIndex * (100);
    slider.style.transform = `translateX(${offset}%)`;
}

// Avis precedents
previousButton.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = totalPages - 1; // Retourner à la dernière page
    }
    updateSlider();
});

// Avis suivants
nextButton.addEventListener('click', () => {
    if (currentIndex < totalPages - 1) {
        currentIndex++;
    } else {
        currentIndex = 0; // Secu retour au début si plus d'avis
    }
    updateSlider();
});

// Add scroll detection for left and right scroll
document.addEventListener('wheel', (event) => {
    if (event.deltaX > 0) {
        // Scroll to the right, go to next review
        if (currentIndex < totalPages - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // Loop back to the first review
        }
    } else if (event.deltaX < 0) {
        // Scroll to the left, go to previous review
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = totalPages - 1; // Loop back to the last review
        }
    }
    updateSlider();
});