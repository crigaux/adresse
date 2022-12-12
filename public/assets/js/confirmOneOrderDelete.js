let deleteBtn2 = document.querySelectorAll('.btnDeleteOrderConf');
let modale2 = document.querySelector('.modale2');
let backBtn2 = document.querySelector('.modale2 button');
let deleteOrderLink2 = document.querySelector('.deleteOneOrderLink');

deleteBtn2.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale2.classList.add('active');
		deleteOrderLink2.href = '/admin/commande/plat/delete/' + e.target.parentNode.parentNode.id;
	})
})

backBtn2.addEventListener('click', () => {
	modale2.classList.remove('active');
})