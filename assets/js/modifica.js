document.addEventListener("DOMContentLoaded", function(_) {
	document.getElementById('accedi').innerHTML = `<h2>Login</h2>
	<form id="loginForm" action="javascript:void(0)">
		<label for="loginEmail">Email:</label>
		<input type="email" id="loginEmail" name="email" required autocomplete="email">
		<label for="loginPassword">Password:</label>
		<input type="password" id="loginPassword" name="password" required autocomplete="current-password">
		<button type="button" data-button-kind="accedi">Annulla</button>
		<button type="submit">Accedi</button>
	</form>`;
	document.getElementById('registrati').innerHTML = `<h2>Registrazione</h2>
	<form id="registratiForm" action="javascript:void(0)">
		<label for="signupUsername">Nome Utente:</label>
		<input type="text" id="signupUsername" name="username" required autocomplete="username">
		<label for="signupEmail">Email:</label>
		<input type="email" id="signupEmail" name="email" required autocomplete="email">
		<label for="signupPassword">Password:</label>
		<input type="password" id="signupPassword" name="password" required autocomplete="new-password">
		<span id="passwordError" class="hidden">Le due password non coincidono.</span>
		<label for="signupConfirmPassword">Ripeti Password:</label>
		<input type="password" id="signupConfirmPassword" name="password" required autocomplete="new-password">
		<button type="button" data-button-kind="registrati">Annulla</button>
		<button type="submit">Registrati</button>
	</form>`;
	document.body.addEventListener("click", function(event) {
		// Check if the clicked element is a button
		if (event.target.tagName === "BUTTON") {
			// Show an alert with the ID of the clicked button
			let id = event.target.dataset.buttonKind
			if (id == null) {
				return;
			}
			else{
				document.getElementById(id).classList.toggle('hidden');
				document.getElementById(id).classList.toggle('allert');
			}
			/*} else if (id.endsWith("Hide")) {
				id = id.replace("Hide", "")
				//document.getElementById(id).style.display = "none"
				
			} else {
				document.getElementById(id).style.display = "flex"
			}*/
		}
	});
})