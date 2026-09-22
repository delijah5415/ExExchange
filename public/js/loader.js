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