// Variables 

let navbarDishes = document.querySelector('.fullDishes');
let navbarDrinks = document.querySelector('.fullDrinks');
let navbarArdoise = document.querySelector('.fullArdoise');

let firstSectionDishes = document.querySelector('.topDishes');
let firstSectionDrinks = document.querySelector('.topDrinks');
let firstSectionArdoise = document.querySelector('.topArdoise');

let containerDishes = document.querySelector('.containerDishes');
let containerDrinks = document.querySelector('.containerDrinks');
let containerArdoise = document.querySelector('.containerArdoise');

let buttonDishes = document.querySelector('.buttonDishes');
let buttonDrinks = document.querySelector('.buttonDrinks');
let buttonArdoise = document.querySelector('.buttonArdoise');

// Functions

function changeMargin(navbar, firstSection) {
    firstSection.style.marginTop = navbar.offsetHeight + 'px';
}

// Event Listeners

window.addEventListener('load', () => {
    changeMargin(navbarDishes, firstSectionDishes);
    if (new Date().getDay() == 0 || new Date().getDay() == 6) {
        buttonArdoise.classList.add('hidden');
    }
    if (new Date().getHours() < 10 || new Date().getHours() > 16) {
        buttonArdoise.classList.add('hidden');
    }
});

buttonDishes.addEventListener('click', () => {
    if (containerDishes.classList.contains('hidden')) {
        containerDishes.classList.remove('hidden');
        navbarDishes.classList.remove('hidden');
    }
    navbarDrinks.classList.add('hidden');
    containerDrinks.classList.add('hidden');
    navbarArdoise.classList.add('hidden');
    containerArdoise.classList.add('hidden');
    changeMargin(navbarDishes, firstSectionDishes);
    window.scrollTo(0, 0);
});

buttonDrinks.addEventListener('click', () => {
    if (containerDrinks.classList.contains('hidden')) {
        containerDrinks.classList.remove('hidden');
        navbarDrinks.classList.remove('hidden');
    }
    containerDishes.classList.add('hidden');
    navbarDishes.classList.add('hidden');
    containerArdoise.classList.add('hidden');
    navbarArdoise.classList.add('hidden');
    changeMargin(navbarDrinks, firstSectionDrinks);
    window.scrollTo(0, 0);
});

buttonArdoise.addEventListener('click', () => {
    if (containerArdoise.classList.contains('hidden')) {
        containerArdoise.classList.remove('hidden');
        navbarArdoise.classList.remove('hidden');
    }
    containerDishes.classList.add('hidden');
    navbarDishes.classList.add('hidden');
    containerDrinks.classList.add('hidden');
    navbarDrinks.classList.add('hidden');
    changeMargin(navbarArdoise, firstSectionArdoise);
    window.scrollTo(0, 0);
});





