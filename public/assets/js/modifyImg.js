let imgForms = document.querySelectorAll('.formDishImg');
let inputs = document.querySelectorAll('.formDishImg input');

document.addEventListener('DOMContentLoaded', function() {
	imgForms.forEach(form => {
		form.children[1].addEventListener('change', function() {
			form.submit();
		});
	})
});

let activeForm = document.querySelectorAll('.formMenuActive');

activeForm.forEach(form => {
	form.addEventListener('click', () => {
		form.submit();
	});
});