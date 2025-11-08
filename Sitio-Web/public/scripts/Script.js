const searchBarCont = document.getElementById("search-bar-container");
const searchButton = document.getElementById("search-button");

const menuToggle = document.getElementById("menu-toggle");
const menuButtonImage = document.getElementById("menu-button-image");

const closeButton = document.getElementById("close-button");

document.querySelectorAll('.item-container').forEach(container => {
    let currentIndex = 0;
    
    const carousel = container.parentElement;
    const carouselCards = container.querySelectorAll('.item');
    const totalCarouselCards = carouselCards.length;

    const nextElButton = carousel.querySelector('.next-element-button');
    const previousElButton = carousel.querySelector('.previous-element-button');

    nextElButton.addEventListener('click', () => {
        if(currentIndex<totalCarouselCards-1) {
            currentIndex++;
            updateTransform(carouselCards, currentIndex);
        }
    });

    previousElButton.addEventListener('click', () => {
        if(currentIndex>0) {
            currentIndex--;
            updateTransform(carouselCards, currentIndex);
        }
    });
});

function updateTransform(cards, currentIndex) {
    cards.forEach((card, index) => {
        const offset = -currentIndex * card.offsetWidth; //dezplazar según el ancho de la tarjetas
        card.style.transform = `translateX(${offset}px)`;
    });
}

searchButton.addEventListener('click', function() {
    searchBarCont.classList.replace("search-bar-container-hidden", "search-bar-container-visible");
    menuToggle.checked = false;
    menuButtonImage.src = "images/menuIcon.svg";
});

closeButton.addEventListener('click', function() {
    searchBarCont.classList.replace("search-bar-container-visible", "search-bar-container-hidden");
});

menuToggle.addEventListener('change', function() {
    if(this.checked){
        menuButtonImage.src = "images/closeIconDark.svg";
    }else {
        menuButtonImage.src = "images/menuIcon.svg";
    }
});



/*
window.addEventListener('load', () => {
    new Glider(document.querySelector('.new-art-item-container'), {
        slidesToScroll: 5,
        slidesToShow: 10,
        draggable: false,
        dots: '.carousel-indicator',
        arrows: {
            prev: '.previous-element-button',
            next: '.next-element-button'
        },
        responsive: [
            {
            // screens greater than >= 775px
            breakpoint: 480,
                settings: {
                    // Set to `auto` and provide item width to adjust to viewport
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },{
            // screens greater than >= 1024px
            breakpoint: 1024,
                settings: {
                    slidesToShow: 10,
                    slidesToScroll: 5,
                }
            }
        ]  
    });
});
*/