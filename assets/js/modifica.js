document.addEventListener("DOMContentLoaded", function(_) {
	
	let popUpAccedi2 = `<h2>Login</h2>
		<div id="loginError" class="hidden">{{ LoginError }}</div>
		<form id="/user/login" onsubmit="return postRequest(event, ['email', 'password'])">
			<label for="loginEmail">Email:</label>
			<input type="email" id="loginEmail" name="email" required autocomplete="email">
			<label for="loginPassword">Password:</label>
			<input type="password" id="loginPassword" name="password" required autocomplete="current-password">
			<input type="button" data-button-kind="accedi">Annulla</button>
			<input type="submit" value="Submit">Accedi</button>
		</form>`;
	let popUpAccedi = `<h2>Login</h2>
		<div id="loginError" class="hidden">{{ LoginError }}</div>
		<label for="loginEmail">Email:</label>
		<input type="email" id="loginEmail" name="email" required autocomplete="email">
		<label for="loginPassword">Password:</label>
		<input type="password" id="loginPassword" name="password" required autocomplete="current-password">
		<button type="button" data-button-kind="accedi">Annulla</button>
		<button type="submit" onclick="postRequest(event, ['email', 'password'])" id="/user/login">Accedi</button>`;
	let popUpRegistrati = `<h2>Registrazione</h2>
		<div id="registrationError" class="hidden">{{ RegistratioError }}</div>
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
		<button onclick="postRequest(event, ['username', 'email', 'password'])" id="/user/register">Registrati</button>`;
	let popUpNewProject = `<h2>Crea un Nuovo Progetto</h2>
		<label for=" inputNomeProgetto">Nome Progetto:</label>
		<input type="text" id="inputNomeProgetto" name="nomeProgetto" required>
		<label for="inputDescrizioneProgetto">Descrizione:</label>
		<textarea id="inputDescrizioneProgetto" name="descrizioneProgetto" required></textarea>
		<button type="button" data-button-kind="newProject">Annulla</button>
		<button onclick="postRequest(event, ['nomeProgetto', 'descrizioneProgetto'])" id="/project/new">Crea Progetto</button>`
	let popUpModifyCredentials = `<h2>Modifica informazioni dell'account</h2>
		<label for="newEmail">Nuova Email:</label>
		<input type="email" id="newEmail" name="newEmail">
		<label for="newUsername">Nuovo Nome Utente:</label>
		<input type="text" id="newUsername" name="newUsername">
		<label for="newPassword">Nuova Password:</label>
		<input type="password" id="newPassword" name="newPassword">
		<label for="confirmNewPassword">Conferma Nuova Password:</label>
		<input type="password" id="confirmNewPassword" name="confirmNewPassword">
		<label for="oldPassword">Vecchia Password:</label>
		<input type="password" id="oldPassword" name="oldPassword" required>
		<button type="button" data-button-kind="modificaCredenziali">Annulla</button>
		<button onclick="postRequest(event, ['newEmail', 'newUsername', 'newPassword', 'confirmNewPassword', 'oldPassword'])" id="/user/modify">Salva Modifiche</button>`;
	let popUpEditProject = `<h2>Modifica Progetto</h2>
		<label for="inputNewNomeProgetto">Nuovo Nome Progetto:</label>
		<input type="text" id="newNewNomeProgetto" name="newNomeProgetto">
		<label for="inputNewDescrizioneProgetto">Nuova Descrizione:</label>
		<textarea id="newDescrizioneProgetto" name="newDescrizioneProgetto"></textarea>
		<button type="button" data-button-kind="deleteProject">Elimina Progetto</button>
		<button type="button" data-button-kind="editProject">Annulla</button>
		<button onclick="postRequest(event, ['newNomeProgetto', 'newDescrizioneProgetto'], true)" id="/project/modify">Salva Modifiche</button>`;

	let diz = { 'accedi': popUpAccedi2, 'registrati': popUpRegistrati,
		'newProject': popUpNewProject, 'modificaCredenziali': popUpModifyCredentials,
		'editProject': popUpEditProject};

	document.body.addEventListener("click", function(event) {
		// Check if the clicked element is a button
		if (event.target.tagName === "BUTTON") {
			// Show an alert with the ID of the clicked button
			let id = event.target.dataset.buttonKind
			if (id == null) {
				return;
			}
			else {
				document.getElementById(id).classList.toggle('hidden');
				document.getElementById(id).classList.toggle('allert');
			}
			if (document.getElementById(id).classList.contains("hidden")) {
				const focusableElements = document.querySelectorAll('a, button, input, textarea, select, [tabindex]');
				focusableElements.forEach(element => {
					element.removeAttribute('tabindex');
				});
				document.getElementById(id).innerHTML = ``;
			}
			else {
				const focusableElements = document.querySelectorAll('a, button, input, textarea, select, [tabindex]');
				focusableElements.forEach(element => {
					element.setAttribute('tabindex', '-1');
				});
				document.getElementById(id).innerHTML = diz[id];	
			}
		}
	});
})

function validaForm() {
	var password1 = document.getElementById("signupPassword").value;
	var password2 = document.getElementById("signupConfirmPassword").value;

	if (password1 !== password2) {
		alert("Le password non corrispondono!");
		return false;
	}
	return true;
}

function validaAccess() {
	const cookieName = "LogIn";
	const decodedCookie = decodeURIComponent(document.cookie);
	const cookieArray = decodedCookie.split(';');

	for (let i = 0; i < cookieArray.length; i++) {
		let cookie = cookieArray[i].trim();
		if (cookie.indexOf(cookieName) === 0) {
			return true;
		}
	}
	alert("Devi fare prima il Log-In");
	return false;
}

function logOut() {
	const cookies = document.cookie.split(";");

	for (let i = 0; i < cookies.length; i++) {
		const cookie = cookies[i];
		const eqPos = cookie.indexOf("=");
		const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
		document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
	}

	window.location.href = '/';
}

function share(link) {
	url = window.location.hostname + `/project_shared?link=${link}`;
	navigator.clipboard.writeText(url).then(function() {
		alert("Testo copiato negli appunti!");
	}).catch(function(error) {
		console.error("Errore durante la copia del testo: ", error);
	});
}

function openProjectPage(link) {
	window.location = `/page_project?link=${link}`;
}


function postRequest(event, params, isModifyProject = false) {
	var datas = {};
	if(isModifyProject) {
		const urlString = window.location.href;
		const url = new URL(urlString);
		const upar = url.searchParams;
		datas = {
			project_id: upar.get('project_id'),
		};
	}
	var queryString = window.location.search;
	if (queryString.charAt(0) === '?') {
		queryString = queryString.slice(1);
	}
	var queryParams = queryString.split('&');

	var section = event.target.parentElement;

	for (var i = 0; i < params.length; i++) {
		console.log(params[i]);
		datas[params[i]] = section.querySelectorAll(`input[name="${params[i]}"], textarea[name="${params[i]}"]`)[0].value;//document.getElementsByName(params[i]);
		console.log(datas[params[i]]);
	}
	queryParams.forEach(function(param) {
		var parts = param.split('=');
		var key = decodeURIComponent(parts[0]);
		var value = decodeURIComponent(parts[1]);
		datas[key] = value;
	});

	fetch(event.target.id, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify(datas)
	})
		.then(response => response.json())
		.then(data => {
			console.log(data['status']);
			if (event.target.id == "/user/login" || event.target.id == "/user/register")
				window.location.href = '/account_home';
			else
				location.reload(true);
		})
		.catch((error) => {
			console.error('Error:', error);
		});
}

function joinProject() {

	if (validaAccess()) {
		const urlString = window.location.href;
		const url = new URL(urlString);
		const params = url.searchParams;

		const datas = {
			link: params.get('link'),
		};

		fetch('/project/join', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(datas)
		})
			.then(response => response.json())
			.then(data => {
				alert(data['status']);
			})
			.catch((error) => {
				console.error('Error:', error);
			});
	}
	else {
		alert("Prima effettuare il login.");
	}
}

function deleteProject(link) {
	if (validaAccess()) {
		const data = {
			link: link,
		};

		fetch('/project/delete', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(data)
		})
			.then(response => response.json())
			.then(data_content => {
				alert(data_content['status']);
				window.location.reload(); // Refresh della pagina
			})
			.catch((error) => {
				console.error('Error:', error);
			});
	}
	else {
		alert("Prima effettuare il login.");
	}
}

function disjoinProject(link) {
	if (validaAccess()) {
		const data = {
			link: link,
		};

		fetch('/project/disjoin', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(data)
		})
			.then(response => response.json())
			.then(data_content => {
				alert(data_content['status']);
				window.location.reload(); // Refresh della pagina
			})
			.catch((error) => {
				console.error('Error:', error);
			});
	}
	else {
		alert("Prima effettuare il login.");
	}
}
