const menuToggle = document.getElementById('menu-toggle');
const mainNav = document.getElementById('main-nav');

<<<<<<< HEAD
if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', () => {
        mainNav.classList.toggle('open');
    });
}
=======
// Додаємо слухача на клік для бургер-меню
menuToggle.addEventListener('click', () => {
    // Перемикаємо клас 'open' для меню
    mainNav.classList.toggle('open');
});

>>>>>>> 1553df9ff9197e2ee5364a3b590da2338cb45ecc
