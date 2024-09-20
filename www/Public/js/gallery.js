document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.gallery--classic__item__picture');
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const captionText = document.getElementById('caption');
    const closeModal = document.querySelector('.close');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    let currentIndex = 0;

    // Fonction pour ouvrir la modale et afficher l'image cliquée
    function openModal(index) {
        currentIndex = index;
        modal.style.display = 'block';
        document.body.classList.add('modal-open'); // Désactive le scroll
        updateModalContent();
    }

    // Fonction pour mettre à jour le contenu de la modale
    function updateModalContent() {
        const currentImage = images[currentIndex];
        const activeItem = document.querySelector('.carousel--item.active');

        if (activeItem) {
            activeItem.classList.remove('active');
        }

        modalImage.src = currentImage.src;
        captionText.innerHTML = `<strong>${currentImage.getAttribute('data-title')}</strong><br>${currentImage.alt}`;

        // Appliquer la transition
        modalImage.classList.add('active');
    }

    // Fermer la modale
    closeModal.onclick = function() {
        modal.style.display = 'none';
        document.body.classList.remove('modal-open'); // Réactive le scroll
    };

    // Fermer la modale si on clique à l'extérieur du contenu (image, titre, etc.)
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
            document.body.classList.remove('modal-open'); // Réactive le scroll
        }
    });

    // Empêcher la fermeture si on clique sur l'image ou le texte dans la modale
    modalImage.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    captionText.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    // Fonction pour passer à l'image précédente
    function showPreviousImage() {
        currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
        updateModalContent();
    }

    // Fonction pour passer à l'image suivante
    function showNextImage() {
        currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
        updateModalContent();
    }

    // Bouton précédent
    prevButton.onclick = function() {
        showPreviousImage();
    };

    // Bouton suivant
    nextButton.onclick = function() {
        showNextImage();
    };

    // Ouvrir la modale lorsqu'une image est cliquée
    images.forEach((image, index) => {
        image.addEventListener('click', function() {
            openModal(index);
        });
    });

    // Fermer la modale avec la touche "Escape"
    window.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            modal.style.display = 'none';
            document.body.classList.remove('modal-open'); // Réactive le scroll
        }
    });

    // Ajouter la navigation avec les touches du clavier
    window.addEventListener('keydown', function(event) {
        if (modal.style.display === 'block') {  // Vérifie si la modale est ouverte
            if (event.key === 'ArrowLeft') {    // Si la touche gauche est pressée
                showPreviousImage();
            }
            if (event.key === 'ArrowRight') {   // Si la touche droite est pressée
                showNextImage();
            }
        }
    });
});
