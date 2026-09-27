const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.review-slide');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');

<<<<<<< HEAD
if (slider && slides.length > 0) {
    let currentIndex =0;
    let autoSlideInterval = null;
=======
let currentIndex = 0;

>>>>>>> 1553df9ff9197e2ee5364a3b590da2338cb45ecc
// Оновлюємо слайдер
function updateSlider() {
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
}

<<<<<<< HEAD
function startSlider() {
    stopAutoSlide();
    autoSlideInterval = setInterval(() => {
        currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
        updateSlider();
    }, 10000;
}

function stopAutoSlide() {
    if (autoSlideInterval) {
        clearInterval(autoSLideInterval);
        autoSlideInterval = null;
    }
}

if (prevBtn) {
    prevBtn.addEventListener('click',  => {
        currentIndex = (currentIndex > 0) ? currentIndex -1 : slides.length -1;
        updateSlider();
    });
    prevBtn.addEventListener('mouseenter', stopAutoSlide);
    prevBtn.addEventListener('mouseleave', startAutoSlide);
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex < slides.length -1) ? currentIndex +1 : 0;
            updateSlider();
        });
        nextBtn.addEventListener('mouseenter', stopAutoSlide);
        nextBtn.addEventListener('mouseeave', startAutoSlide);
    }

    startAutoSlide();
}
=======
// Кнопка "Назад"
prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : slides.length - 1;
    updateSlider();
});

// Кнопка "Вперед"
nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
    updateSlider();
});

// Автоматична зміна слайдів
function autoSlide() {
    currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
    updateSlider();
}

// Запуск автоматичного слайдера
const autoSlideInterval = setInterval(autoSlide, 10000);

// Зупинка автослайдера при взаємодії з кнопками
prevBtn.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
nextBtn.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));

// Поновлення автослайдера після взаємодії
prevBtn.addEventListener('mouseleave', () => setInterval(autoSlide, 10000));
nextBtn.addEventListener('mouseleave', () => setInterval(autoSlide, 10000));
>>>>>>> 1553df9ff9197e2ee5364a3b590da2338cb45ecc
