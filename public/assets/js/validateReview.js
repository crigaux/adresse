let forms = document.querySelectorAll('.formReviewValidate');

document.addEventListener('DOMContentLoaded', () => {
	forms.forEach(form => {
		form.children[0].addEventListener('click', () => {
			console.log('click');
			if(form.children[0].classList.contains('reviewLabel')) {
				form.submit();
			}
		});
	})
});