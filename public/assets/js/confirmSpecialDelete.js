let deleteBtn = document.querySelectorAll('.btnDeleteConf');
let modale = document.querySelector('.modale');
let backBtn = document.querySelector('.modaleBtn button');
let deleteSpecialLink = document.querySelector('.deleteSpecialLink');

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteSpecialLink.href = '/admin/ardoise/delete/' + e.target.id
	})
})

backBtn.addEventListener('click', () => {
	modale.classList.remove('active');
})