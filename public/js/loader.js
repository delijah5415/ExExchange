<<<<<<< HEAD
function hideLoader() {
    const loader = document.querySelector('.loader');
    if (!loader) return;

    setTimeout(() => {
        loader.Style.opacity = '0';
        setTimeout(() => {
            loader.style.display ='none';
        }, 500);
    }, 1500);
}

    if (document.readyState === 'complete') {
        hideLoader();
    } else {
        window.addEventListener('load', hideLoader);
    }
=======
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
>>>>>>> 1553df9ff9197e2ee5364a3b590da2338cb45ecc
