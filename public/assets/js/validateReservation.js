let forms = document.querySelectorAll('.formReservationValidate');

document.addEventListener('DOMContentLoaded', () => {
	forms.forEach(form => {
		form.children[0].addEventListener('click', () => {
			if(form.children[0].classList.contains('reservationLabel')) {
				form.submit();
			}
		});
	})
});