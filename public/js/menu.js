const menuToggle = document.getElementById('menu-toggle');
const mainNav = document.getElementById('main-nav');

// Додаємо слухача на клік для бургер-меню
menuToggle.addEventListener('click', () => {
    // Перемикаємо клас 'open' для меню
    mainNav.classList.toggle('open');
});

