document.addEventListener("DOMContentLoaded", function () {
    const loader = document.querySelector('.loader'); // Знаходимо елемент завантажувача
    window.addEventListener('load', () => {
        setTimeout(() => {
            loader.style.opacity = '0'; // Плавне зникнення
            setTimeout(() => {
                loader.style.display = 'none'; // Повне приховування
            }, 500); // Час анімації відповідно до CSS
        }, 3000); // Затримка в 3 секунди
    });
    
});