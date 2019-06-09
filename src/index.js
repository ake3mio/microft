import Siema from 'siema';

const slides = document.querySelectorAll('.siema');

for (let i = 0; i < slides.length; i++) {

    const slide = slides[i];

    const siema = new Siema({
        selector: slide,
        duration: 1500,
        easing: 'ease-out',
        perPage: 1,
        startIndex: 0,
        draggable: true,
        multipleDrag: true,
        threshold: 20,
        loop: true,
        rtl: false,
        onInit: () => {
        },
        onChange: next,
    });

    next();

    function next() {
        setTimeout(() => siema.next(), 4000)
    }
}
