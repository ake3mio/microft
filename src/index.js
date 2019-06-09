import Siema from 'siema';

const slides = document.querySelectorAll('.siema');

for (let i = 0; i < slides.length; i++) {

    const slide = slides[i];

    if (slide.children.length) {
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
}

const query = searchToObject();

window.addEventListener('DOMContentLoaded', (event) => {
    if (query['submit_succeeded'] === 'false' || document.querySelector('.submit-feedback')) {
        smoothScroll('.contact-form')
    }
});

function currentYPosition() {
    // Firefox, Chrome, Opera, Safari
    if (self.pageYOffset) return self.pageYOffset;
    // Internet Explorer 6 - standards mode
    if (document.documentElement && document.documentElement.scrollTop)
        return document.documentElement.scrollTop;
    // Internet Explorer 6, 7 and 8
    if (document.body.scrollTop) return document.body.scrollTop;
    return 0;
}


function elmYPosition(cssSelector) {
    let elm = document.querySelector(cssSelector);
    let y = elm.offsetTop;
    let node = elm;
    while (node.offsetParent && node.offsetParent != document.body) {
        node = node.offsetParent;
        y += node.offsetTop;
    }
    return y;
}


function smoothScroll(cssSelector) {
    let startY = currentYPosition();
    let stopY = elmYPosition(cssSelector);
    let distance = stopY > startY ? stopY - startY : startY - stopY;
    if (distance < 100) {
        scrollTo(0, stopY);
        return;
    }
    let speed = Math.round(distance / 100);
    if (speed >= 20) speed = 20;
    let step = Math.round(distance / 25);
    let leapY = stopY > startY ? startY + step : startY - step;
    let timer = 0;
    if (stopY > startY) {
        for (let i = startY; i < stopY; i += step) {
            setTimeout("window.scrollTo(0, " + leapY + ")", timer * speed);
            leapY += step;
            if (leapY > stopY) leapY = stopY;
            timer++;
        }
        return;
    }
    for (let i = startY; i > stopY; i -= step) {
        setTimeout("window.scrollTo(0, " + leapY + ")", timer * speed);
        leapY -= step;
        if (leapY < stopY) leapY = stopY;
        timer++;
    }
}

function searchToObject() {
    return window.location.search.substring(1).split("&").reduce(function (result, value) {
        let parts = value.split('=');
        if (parts[0]) result[decodeURIComponent(parts[0])] = decodeURIComponent(parts[1]);
        return result;
    }, {})
}
