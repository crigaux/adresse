let deleteBtn = document.querySelectorAll('.btnDeleteConf');
let modale = document.querySelector('.modale');
let backBtn = document.querySelector('.modaleBtn button');
let deleteDrinkLink = document.querySelector('.deleteDrinkLink');

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteDrinkLink.href = '/admin/boissons/delete/' + e.target.id
	})
})

backBtn.addEventListener('click', () => {
	modale.classList.remove('active');
})