const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.review-slide');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');

let currentIndex = 0;

// Оновлюємо слайдер
function updateSlider() {
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
}

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
