document.addEventListener("DOMContentLoaded", function(_) {
	let popUpAccedi = `<h2>Login</h2>
	<form id="loginForm" action="javascript:void(0)">
		<label for="loginEmail">Email:</label>
		<input type="email" id="loginEmail" name="email" required autocomplete="email">
		<label for="loginPassword">Password:</label>
		<input type="password" id="loginPassword" name="password" required autocomplete="current-password">
		<button type="button" data-button-kind="accedi">Annulla</button>
		<button type="submit">Accedi</button>
	</form>`;
	let popUpRegistrati = `<h2>Registrazione</h2>	<form id="registratiForm" action="/registration", method="post",  onsubmit="return validaForm()">
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
	let popUpNewProject = `<h2>Crea un Nuovo Progetto</h2>
	<form id="newProjectForm" action="/account_home", method="post">
		<label for=" inputNomeProgetto">Nome Progetto:</label>
		<input type="text" id="inputNomeProgetto" name="nomeProgetto" required>
		<label for="inputDescrizioneProgetto">Descrizione:</label>
		<textarea id="inputDescrizioneProgetto" name="descrizioneProgetto" required></textarea>
		<div class="form-buttons">
			<button type="button" data-button-kind="newProject">Annulla</button>
			<button type="submit" id="submitNewProject">Crea Progetto</button>
		</div>
	</form>`
	let diz = {'accedi': popUpAccedi, 'registrati':popUpRegistrati, 'newProject':popUpNewProject};
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

				if(document.getElementById(id).classList.contains("hidden"))
				{
					document.getElementById(id).innerHTML = ``;
				}
				else{
					document.getElementById(id).innerHTML = diz[id];
				}
			}
		}
	});
})

function validaForm()
{
	var password1 = document.getElementById("signupPassword").value;
	var password2 = document.getElementById("signupConfirmPassword").value;

	if (password1 !== password2) {
		alert("Le password non corrispondono!");
		return false;
	}
	return true;
}