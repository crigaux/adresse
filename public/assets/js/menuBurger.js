let openBtn = document.querySelector('.menu');
let closeBtn = document.querySelector('.close');

let overlay = document.querySelector('.overlayMenuBurger');

openBtn.addEventListener('click', () => {
	overlay.classList.add('open');
	overlay.classList.remove('close');
});

closeBtn.addEventListener('click', () => {
	overlay.classList.remove('open');
	overlay.classList.add('close');
});