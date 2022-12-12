let openBtnDB = document.querySelector('.openBurger');
let closeBtnDB = document.querySelector('.closeBurger');

let sidebar = document.querySelector('.sidebar');

openBtnDB.addEventListener('click', () => {
	sidebar.classList.add('open');
});

closeBtnDB.addEventListener('click', () => {
	sidebar.classList.remove('open');
});