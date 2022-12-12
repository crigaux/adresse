let deleteBtn = document.querySelectorAll('.btnDeleteConf');
let modale = document.querySelector('.modale');
let backBtn = document.querySelector('.modaleBtn button');
let deleteUserLink = document.querySelector('.deleteUserLink');

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteUserLink.href = '/profil/user/delete';
	})
})

backBtn.addEventListener('click', () => {
	modale.classList.remove('active');
})