function changeTheme() {
    let currentTheme = localStorage.getItem('theme');

    if (!currentTheme || currentTheme === 'light') {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }

    applyTheme();
}

function applyTheme() {
    const theme = localStorage.getItem('theme');
    const actionElement = document.getElementById('theme');
    const mainElement = document.getElementById('main');
    const themeIcon = document.getElementById('themeIcon');

    if (theme === 'dark') {
        mainElement.classList.remove('light-theme');
        mainElement.classList.add('dark-theme');
        actionElement.classList.add('light-theme');
        actionElement.classList.remove('dark-theme');
        themeIcon.src = '/assets/sun.svg';
    } else {
        mainElement.classList.remove('dark-theme');
        mainElement.classList.add('light-theme');
        actionElement.classList.add('dark-theme');
        mainElement.classList.remove('light-theme');
        themeIcon.src = '/assets/moon.svg';
    }
}

applyTheme();
document.getElementById('themelink').addEventListener('click', function(e) {
    e.preventDefault();
    changeTheme();
});
