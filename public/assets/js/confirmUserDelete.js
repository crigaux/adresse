let deleteBtn = document.querySelectorAll('.btnDeleteConf');
let modale = document.querySelector('.modale');
let backBtn = document.querySelector('.modaleBtn button');
let deleteUserLink = document.querySelector('.deleteUserLink');

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteUserLink.href = '/admin/membre/delete/' + e.target.id;
	})
})

backBtn.addEventListener('click', () => {
	modale.classList.remove('active');
})