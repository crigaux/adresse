// ##############################################################
// ###########             Aperçu du menu             ###########
// ##############################################################

let starter = document.querySelector('#starterPreview');
let mainDishes = document.querySelector('#mainDishesPreview');
let dessert = document.querySelector('#dessertPreview');
let drinks = document.querySelector('#drinksPreview');
let container = document.querySelector('.catDishesContainer')

starter.addEventListener('click', () => {
    fetch(`/getLastStartersAjax`)
        .then(response => response.json())
        .then(data => {
            container.innerHTML = '';
            data.forEach(element => {
                container.innerHTML +=   
                    `<div class="catDishiesItem">
                    <div class="catDishiesItemTitle">
                        <h4>${element.title}</h4>
                        <span>${element.price}€</span>
                    </div>
                    <p>${element.description}</p>
                    </div>
                    `
            })
    })
})
mainDishes.addEventListener('click', () => {
    fetch(`/getLastDishesAjax`)
        .then(response => response.json())
        .then(data => {
            container.innerHTML = '';
            data.forEach(element => {
                container.innerHTML +=   
                    `<div class="catDishiesItem">
                    <div class="catDishiesItemTitle">
                        <h4>${element.title}</h4>
                        <span>${element.price}€</span>
                    </div>
                    <p>${element.description}</p>
                    </div>
                    `
            })
    })
})
dessert.addEventListener('click', () => {
    fetch(`/getLastDessertsAjax`)
        .then(response => response.json())
        .then(data => {
            container.innerHTML = '';
            data.forEach(element => {
                container.innerHTML +=   
                    `<div class="catDishiesItem">
                    <div class="catDishiesItemTitle">
                        <h4>${element.title}</h4>
                        <span>${element.price}€</span>
                    </div>
                    <p>${element.description}</p>
                    </div>
                    `
            })
    })
})