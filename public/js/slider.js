const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.review-slide');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');

if (slider && slides.length > 0) {
    let currentIndex =0;
    let autoSlideInterval = null;
// Оновлюємо слайдер
function updateSlider() {
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
}

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