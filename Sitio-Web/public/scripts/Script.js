const searchBarCont = document.getElementById("search-bar-container");
const searchBarButton = document.getElementById("search-bar-button");
const searchBarInput = document.getElementById("search-bar-input");
const closeButton = document.getElementById("close-button");

const searchButton = document.getElementById("search-button");

const menuToggle = document.getElementById("menu-toggle");
const menuButtonImage = document.getElementById("menu-button-image");

//por cada contenedor de tarjetas
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
            updateTransform(carouselCards, currentIndex, container);
        }
    });

    previousElButton.addEventListener('click', () => {
        if(currentIndex>0) {
            currentIndex--;
            updateTransform(carouselCards, currentIndex, container);
        }
    });
});

function updateTransform(cards, currentIndex, container) {
    cards.forEach((card, index) => {
        const offset = -currentIndex * card.offsetWidth; //dezplazar según el ancho de la tarjetas
        card.style.transform = `translateX(${offset}px)`;
        container.scrollBy(offset, 0);
    });
}

searchButton.addEventListener('click', function() {
    searchBarCont.classList.replace("search-bar-container-hidden", "search-bar-container-visible");
    menuToggle.checked = false;
    menuButtonImage.src = `${ASSETS_PATH}/images/menuIcon.svg`;

    if(searchBarCont.classList = "search-bar-container-visible") {
        searchBarInput.focus();
    }
});

searchBarButton.addEventListener('click', function() {
    if(searchBarInput.value!=="") {
        const searchBarInput = document.getElementById("search-bar-input");
        window.location = `${BASE_PATH}/search/${searchBarInput.value}`;
    }
    //window.location.pathname = `${SRC_PATH}/views/searchResult.php/${searchBarInput.value}`;
    //window.history.pushState(null, null, `${SRC_PATH}/views/searchResult.php/${searchBarInput.value}`);
    //$(window).bind("popstate", function(e) { alert("location changed"); });
});

closeButton.addEventListener('click', function() {
    searchBarCont.classList.replace("search-bar-container-visible", "search-bar-container-hidden");
});

menuToggle.addEventListener('change', function() {
    if(this.checked){
        menuButtonImage.src = `${ASSETS_PATH}/images/closeIconDark.svg`;
    }else {
        menuButtonImage.src = `${ASSETS_PATH}/images/menuIcon.svg`;
    }
});

searchBarInput.addEventListener('keydown', function(e) {
    let pressedKey = e.key;
    e.preventDefault();

    switch(pressedKey) {
        default:
            searchBarInput.value += pressedKey;
        break;

        case 'Backspace':
            //eliminar último caracter
            let operation = searchBarInput.value.substring(0, searchBarInput.value.length-1); 
            searchBarInput.value = operation;
        break;
        
        case 'Enter':
            if(searchBarInput.value!=="") {
                window.location = `${SRC_PATH}/views/searchResult.php/?search=${searchBarInput.value}`;
            }
        break;
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