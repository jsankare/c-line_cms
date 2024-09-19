document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.gallery--classic__item__picture');
    const modal = document.getElementById('imageModal');
    const carouselItems = document.querySelectorAll('.carousel--item');
    const captionText = document.getElementById('caption');
    const closeModal = document.querySelector('.close');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    let currentIndex = 0;

    // Open the modal and slider with the clicked image
    function openModal(index) {
        currentIndex = index;
        modal.style.display = 'block';
        updateModalContent();
    }

    // Update modal content with the current image
    function updateModalContent() {
        carouselItems.forEach((item, index) => {
            item.style.display = index === currentIndex ? 'block' : 'none';
        });
        captionText.innerHTML = carouselItems[currentIndex].alt;
    }

    // Close the modal
    closeModal.onclick = function() {
        modal.style.display = 'none';
    };

    // Previous image
    prevButton.onclick = function() {
        currentIndex = (currentIndex === 0) ? carouselItems.length - 1 : currentIndex - 1;
        updateModalContent();
    };

    // Next image
    nextButton.onclick = function() {
        currentIndex = (currentIndex === carouselItems.length - 1) ? 0 : currentIndex + 1;
        updateModalContent();
    };

    // Handle image click to open modal
    images.forEach((image, index) => {
        image.addEventListener('click', function() {
            openModal(index);
        });
    });

    // Close modal on click outside the image
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    // Close modal with escape key
    window.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            modal.style.display = 'none';
        }
    });
});
