let deleteBtn = document.querySelectorAll('.btnDeleteConf');
let modale = document.querySelector('.modale');
let backBtn = document.querySelector('.modaleBtn button');
let deleteMenuLink = document.querySelector('.deleteMenuLink');
let deleteReservationLink = document.querySelector('.deleteReviewLink');

deleteBtn.forEach((btn) => {
	btn.addEventListener('click', (e) => {
		modale.classList.add('active');
		deleteReservationLink.href = '/admin/commentaire/delete/' + e.target.id;
	})
})

backBtn.addEventListener('click', () => {
	modale.classList.remove('active');
})