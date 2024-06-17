document.addEventListener("DOMContentLoaded", function() {
	// document.getElementById("registratiForm").addEventListener("submit", function(event) {
	// 	let password = document.getElementById("signupPassword").value;
	// 	let confirmPassword = document.getElementById("signupConfirmPassword").value;

	// 	if (password !== confirmPassword) {
	// 		console.log(password, confirmPassword)
	// 		document.getElementById("signupConfirmPassword")
	// 			.setCustomValidity("Le password non coincidono")
	// 		event.preventDefault();
	// 		return false;
	// 	} else {
	// 		document.getElementById("signupConfirmPassword")
	// 			.setCustomValidity("")
	// 	}
	// })

	// document.getElementById("signupConfirmPassword").addEventListener("input", function(_) {
	// 	let password = document.getElementById("signupPassword").value;
	// 	let confirmPassword = document.getElementById("signupConfirmPassword").value;

	// 	if (password !== confirmPassword) {
	// 		console.log(password, confirmPassword)
	// 		document.getElementById("signupConfirmPassword")
	// 			.setCustomValidity("Le password non coincidono")
	// 	} else {
	// 		document.getElementById("signupConfirmPassword")
	// 			.setCustomValidity("")
	// 	}
	// })

	// let loginForm = document.getElementById("loginForm");
	// loginForm.addEventListener("submit", function(event) {
	// 	// previene l'auto-invio del form 
	// 	event.preventDefault();

	// 	// let formData = new FormData(event.target);
	// 	let email = document.getElementById("loginEmail").value;
	// 	let password = document.getElementById("loginPassword").value;
	// 	console.log(email)
	// 	console.log(password)
	// 	// fetch(event.target.action, {
	// 	// 	method: "post",
	// 	// 	body: formData,

	// 	// }).then(response => {
	// 	// 	if (!response.ok) {
	// 	// 		document.getElementById("error-text").innerText = response.body.error;
	// 	// 		document.getElementById("error-message").style.display = "flex";
	// 	// 		console.log(response, response.body);
	// 	// 	}
	// 	// 	else {
	// 	// 		window.location.href = 'account_home.php';
	// 	// 	}
	// 	// }).catch(error => {
	// 	// 	// document.getElementById("loginError").innerText = error.body.error;
	// 	// 	console.log('There was a problem with the fetch operation:', error);
	// 	// });
	// })

	// document.getElementById("registratiForm").addEventListener("submit", function(event) {
	// 	event.preventDefault();

	// 	let formData = new FormData(event.target);
	// 	fetch(event.target.action, {
	// 		method: "post",
	// 		body: formData,
	// 	}).then(response => {
	// 		if (!response.ok) {
	// 			document.getElementById("error-text").innerText = response.body.error;
	// 			document.getElementById("error-message").style.display = "flex";
	// 			console.log(response, response.body);
	// 		}
	// 		else {
	// 			window.location.href = 'account_home.php';
	// 		}
	// 	}).catch(error => {
	// 		console.error('There was a problem with the fetch operation:', error);
	// 	});
	// })

})
