let user = JSON.parse(sessionStorage.getItem('user'));

if (user != null) {
	let accediLi = document.querySelector('.login-list li:nth-child(1)');
	let registratiLi = document.querySelector('.login-list li:nth-child(2)');
	let utenteLi = document.querySelector('.login-list li.hidden');

	accediLi.classList.add('hidden');
	registratiLi.classList.add('hidden');
	utenteLi.classList.remove('hidden');
}

// Event listener per il form di registrazione
document.getElementById("registratiForm").addEventListener("submit", function(event) {

	let password = document.getElementById("signupPassword").value;
	let confirmPassword = document.getElementById("signupConfirmPassword").value;

	if (password !== confirmPassword) {
		document.getElementById("signupConfirmPassword")
			.setCustomValidity("Le password non coincidono")
		return
	}
})

document.getElementById("signupConfirmPassword").addEventListener("input", function(_) {
	let password = document.getElementById("signupPassword").value;
	let confirmPassword = document.getElementById("signupConfirmPassword").value;

	if (password !== confirmPassword) {
		document.getElementById("signupConfirmPassword")
			.setCustomValidity("Le password non coincidono")
	}
})
