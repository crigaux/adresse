// Variables 

let NavbarDishes = document.querySelector('.fullDishes');
let NavbarDrinks = document.querySelector('.fullDrinks');
let NavbarArdoise = document.querySelector('.fullArdoise');

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
    changeMargin(NavbarDishes, firstSectionDishes);
    if (new Date().getDay() == 0 || new Date().getDay() == 6) {
        buttonArdoise.classList.add('hidden');
    }
    if (new Date().getHours() < 11 || new Date().getHours() > 16) {
        buttonArdoise.classList.add('hidden');
    }
});

buttonDishes.addEventListener('click', () => {
    if (containerDishes.classList.contains('hidden')) {
        containerDishes.classList.remove('hidden');
    }
    containerDrinks.classList.add('hidden');
    containerArdoise.classList.add('hidden');
    window.scrollTo(0, 0);
});

buttonDrinks.addEventListener('click', () => {
    changeMargin(NavbarDrinks, firstSectionDrinks);
    if (containerDrinks.classList.contains('hidden')) {
        containerDrinks.classList.remove('hidden');
    }
    containerDishes.classList.add('hidden');
    containerArdoise.classList.add('hidden');
    window.scrollTo(0, 0);
});

buttonArdoise.addEventListener('click', () => {
    changeMargin(NavbarArdoise, firstSectionArdoise);
    if (containerArdoise.classList.contains('hidden')) {
        containerArdoise.classList.remove('hidden');
    }
    containerDishes.classList.add('hidden');
    containerDrinks.classList.add('hidden');
    window.scrollTo(0, 0);
});





