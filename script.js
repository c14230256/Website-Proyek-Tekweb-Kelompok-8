document.addEventListener('DOMContentLoaded', (event) => {
    let index = 0;
    const slides = document.querySelectorAll('.container-1-slide');
    const totalSlides = slides.length;

    document.getElementById('container-1-left-arrow').addEventListener('click', () => {
        index = (index > 0) ? index - 1 : totalSlides - 1;
        updateSlidePosition();
    });

    document.getElementById('container-1-right-arrow').addEventListener('click', () => {
        index = (index < totalSlides - 1) ? index + 1 : 0;
        updateSlidePosition();
    });

    function updateSlidePosition() {
        for (let slide of slides) {
            slide.classList.remove('active-slide');
            slide.style.transform = `translateX(-${index * 100}%)`;
        }
    }
});
