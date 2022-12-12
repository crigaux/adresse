const dishesContainer = document.querySelector('dishes');
const input = document.querySelector('.searchBar input');

fetch(`/getPatient/${input.value}`)
	.then(response => response.json())
	.then(data => {
		patientsContainer.innerHTML = '';
		data.forEach(element => {
			patientsContainer.innerHTML += 
			`<option>${element.title}</option>`;
		});
	})