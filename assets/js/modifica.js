document.addEventListener("DOMContentLoaded", function(_) {
	
	let popUpAccedi = `<h2><span lang="en">Login</span></h2>
		<form id="/user/login">
			<div id="loginError" class="hidden">{{ LoginError }}</div>
			<label for="loginEmail"><span lang="en">Email</span>:</label>
			<input type="email" id="loginEmail" name="email" required autocomplete="email">
			<label for="loginPassword"><span lang="en">Password</span>:</label>
			<input type="password" id="loginPassword" name="password" required autocomplete="current-password">
			<input type="checkbox" onclick="toogleView()">Mostra <span lang="en">Password</span>
			<input type="button" data-button-kind="accedi" value="Annulla">
			<input type="submit" value="Accedi">
		</form>`;
	let popUpRegistrati = `<h2>Registrazione</h2>
		<form id="/user/register">
			<div id="registrationError" class="hidden">{{ RegistratioError }}</div>
			<label for="signupUsername">Nome Utente:</label>
			<input type="text" id="signupUsername" name="username" required autocomplete="username">
			<label for="signupEmail"><span lang="en">Email</span>:</label>
			<input type="email" id="signupEmail" name="email" required autocomplete="email">
			<label for="signupPassword"><span lang="en">Password</span>:</label>
			<input type="password" id="signupPassword" name="password" required autocomplete="new-password">
			<input type="checkbox" onclick="toogleView()">Mostra <span lang="en">Password</span>
			<span id="passwordError" class="hidden">Le due <span lang="en">password</span> non coincidono.</span>
			<label for="signupConfirmPassword">Ripeti <span lang="en">Password</span>:</label>
			<input type="password" id="signupConfirmPassword" name="password" required autocomplete="new-password">
			<input type="checkbox" onclick="toogleView()">Mostra <span lang="en">Password</span>
			<input type="button" data-button-kind="registrati" value="Annulla">
			<input type="submit" value="Registrati">
		</form>`;
	let popUpNewProject = `<h2>Crea un Nuovo Progetto</h2>
		<form id="/project/new">
			<div id="newProjectError" class="hidden">{{ NewProjectError }}</div>
			<label for=" inputNomeProgetto">Nome Progetto:</label>
			<input type="text" id="inputNomeProgetto" name="nomeProgetto" required>
			<label for="inputDescrizioneProgetto">Descrizione:</label>
			<textarea id="inputDescrizioneProgetto" name="descrizioneProgetto"></textarea>
			<input type="button" data-button-kind="newProject" value="Annulla">
			<input type="submit" value="Crea Progetto">
		</form>`
	let popUpModifyCredentials = `<h2>Modifica informazioni dell'account</h2>
		<form id="/user/modify">
			<div id="modifyError" class="hidden">{{ ModifyError }}</div>
			<label for="newEmail">Nuova <span lang="en">Email</span>:</label>
			<input type="email" id="newEmail" name="newEmail">
			<label for="newUsername">Nuovo Nome Utente:</label>
			<input type="text" id="newUsername" name="newUsername">
			<label for="newPassword">Nuova <span lang="en">Password</span>:</label>
			<input type="password" id="newPassword" name="newPassword">
			<input type="checkbox" onclick="toogleView()">Mostra <span lang="en">Password</span>
			<label for="confirmNewPassword">Conferma Nuova <span lang="en">Password</span>:</label>
			<input type="password" id="confirmNewPassword" name="confirmNewPassword">
			<input type="checkbox" onclick="toogleView()">Mostra <span lang="en">Password</span>
			<label for="oldPassword">Vecchia <span lang="en">Password</span>:</label>
			<input type="password" id="oldPassword" name="oldPassword" required>
			<input type="checkbox" onclick="toogleView()">Mostra <span lang="en">Password</span>
			<input type="button" data-button-kind="modificaCredenziali" value="Annulla">
			<input type="submit" value="Salva Modifiche">
		</form>`;
	let popUpEditProject = `<h2>Modifica Progetto</h2>
		<form id="/project/modify">
			<div id="modifyProjectError" class="hidden">{{ ModifyProjectError }}</div>
			<label for="inputNewNomeProgetto">Nuovo Nome Progetto:</label>
			<input type="text" id="newNewNomeProgetto" name="newNomeProgetto">
			<label for="inputNewDescrizioneProgetto">Nuova Descrizione:</label>
			<textarea id="newDescrizioneProgetto" name="newDescrizioneProgetto"></textarea>
			<input type="button" data-button-kind="editProject" value="Annulla">
			<input type="submit" value="Salva Modifiche">
		</form>`;

	let diz = { 'accedi': popUpAccedi, 'registrati': popUpRegistrati,
		'newProject': popUpNewProject, 'modificaCredenziali': popUpModifyCredentials,
		'editProject': popUpEditProject};

	document.body.addEventListener("click", function(event) {
		// Check if the clicked element is a button
		if (event.target.tagName === "INPUT") {
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

	document.body.addEventListener("submit", function(event) {
		if (event.target.tagName === "FORM") {
			event.preventDefault();
			postRequest(event);
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

function postRequest(event/*,isModifyProject = false*/) {
	var datas = {};
	/*if(isModifyProject) {
		const urlString = window.location.href;
		const url = new URL(urlString);
		const upar = url.searchParams;
		datas = {
			project_id: upar.get('project_id'),
		};
	}*/

	const elements = document.querySelectorAll('section.allert input[name], section.allert textarea[name]');
	elements.forEach(element => {
		datas[element.name] = element.value;
	});

	const urlString = window.location.href;
	const url = new URL(urlString);
	const upar = url.searchParams;

	upar.forEach((value, key) => {
		const decodedKey = decodeURIComponent(key);
		const decodedValue = decodeURIComponent(value);
		datas[decodedKey] = decodedValue;
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
			alert(error)
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
				window.location.reload();
			})
			.catch((error) => {
				console.error('Error:', error);
			});
	}
	else {
		alert("Prima effettuare il login.");
	}
}

function toogleView() {
	var elements = document.getElementsByName("password");
	for (var i = 0; i < elements.length; i++) {
		if (elements[i].type === "password") {
			elements[i].type = "text";
		} else {
			elements[i].type = "password";
		}
	}
}