let deleteBtn = document.querySelectorAll('.btnDeleteConf');
let modale = document.querySelector('.modale');
let backBtn = document.querySelector('.modaleBtn button');
let deleteMenuLink = document.querySelector('.deleteMenuLink');
let deleteReservationLink = document.querySelector('.deleteReservationLink');
let deleteOrderLink = document.querySelector('.deleteOrderLink');

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteMenuLink.href = '/admin/menu/delete/' + e.target.id
	})
})

backBtn.addEventListener('click', () => {
	modale.classList.remove('active');
})