const toggleButton = document.querySelector('.navbar-toggle');
const closeButton = document.querySelector('.navbar-close');
const navbar = document.querySelector('.navbar');
const navbarMenu = document.querySelector('.navbar-menu');

const dropdownButtons = document.querySelectorAll('.dropbtn');

dropdownButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le lien d'être suivi
        const dropdownContent = button.nextElementSibling;
        dropdownContent.classList.toggle('active');
    });
});

// Ouvre le menu
toggleButton.addEventListener('click', () => {
    navbar.classList.add('active');
});

// Ferme le menu
closeButton.addEventListener('click', () => {
    navbar.classList.remove('active');
});
