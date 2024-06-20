document.addEventListener("DOMContentLoaded", function(_) {
	const urlString = window.location.href;
	const url = new URL(urlString);
	const upar = url.searchParams;

	if (upar.size > 0) {
		params = [];
		upar.forEach((value, key) => {
			const decodedKey = decodeURIComponent(key);
			const decodedValue = decodeURIComponent(value);
			params[decodedKey] = decodedValue;
		});

		// se vi è un feedback da visualizzare nella pagina destinazione.
		if (params["redirect_message"]) {
			console.log(
				"messaggio di redirezione presente all'interno dei parametri"
			);
			const message = params["redirect_message"];
			makePopUpAppear("success", message);
			removeUrlParameter("redirect_message");
		}
	}

	// Funzione che rimuove parametri specifici dall'url. 
	function removeUrlParameter(parameter) {
		let url = new URL(window.location.href);
		url.searchParams.delete(parameter);
		window.history.replaceState({}, document.title, url.toString());
	}

	// Example: Remove 'param1' from the URL

	let popUpAccedi = `<h2>Login</h2>
		<div id="loginError" class="hidden">{{ LoginError }}</div>
		<form id="loginForm" action="/user/login" method="POST">
			<label for="loginEmail">Email:</label>
			<input type="email" id="loginEmail" name="email" required autocomplete="email">
			<label for="loginPassword"><span lang="en">Password</span>:</label>
			<input type="password" id="loginPassword" name="password" required autocomplete="current-password">
			<input type="checkbox" onclick="toogleView()">Mostra <span lang="en">Password</span>
			<div>
				<input type="button" data-button-kind="accedi" value="Annulla">
				<input type="submit" value="Accedi">
			</div>
		</form>`;

	let popUpRegistrati = `<h2>Registrazione</h2>
		<div id="registrationError" class="hidden">{{ RegistratioError }}</div>
		<form id="registratiForm" action="/user/register">
			<label for="signupUsername">Nome Utente:</label>
			<input type="text" id="signupUsername" name="username" required autocomplete="username">
			<label for="signupEmail"><span lang="en">Email</span>:</label>
			<input type="email" id="signupEmail" name="email" required autocomplete="email">
			<label for="signupPassword"><span lang="en">Password</span>:</label>
			<input type="password" id="signupPassword" name="password" required autocomplete="new-password">
			<input type="checkbox" onclick="toogleView()">Mostra <span lang="en">Password</span>
			<span id="passwordError" class="hidden">Le due <span lang="en">password</span> non coincidono.</span>
			<label for="signupConfirmPassword">Ripeti <span lang="en">Password</span>:</label>
			<input type="password" id="signupConfirmPassword" name="confirmpassword" required autocomplete="new-password">
			<input type="checkbox" onclick="toogleView('confirmpassword')">Mostra <span lang="en">Password</span>
			<div>
				<input type="button" data-button-kind="registrati" value="Annulla">
				<input type="submit" value="Registrati">
			</div>
		</form>`;

	let popUpNewProject = `<h2>Crea un Nuovo Progetto</h2>
		<div id="newProjectError" class="hidden">{{ NewProjectError }}</div>
		<form id="nuovoProgettoForm" action="/project/new">
			<label for=" inputNomeProgetto">Nome Progetto:</label>
			<input type="text" id="inputNomeProgetto" name="nomeProgetto" required>
			<label for="inputDescrizioneProgetto">Descrizione:</label>
			<textarea id="inputDescrizioneProgetto" name="descrizioneProgetto"></textarea>
			<input type="button" data-button-kind="newProject" value="Annulla">
			<input type="submit" value="Crea Progetto">
		</form>`;

	let popUpModifyCredentials = `<h2>Modifica informazioni dell'account</h2>
		<div id="modifyError" class="hidden">{{ ModifyError }}</div>
		<form id="modificaCredenzialiForm" action="/user/modify" onsubmit="return validaForm()">
			<label for="newEmail">Nuova <span lang="en">Email</span>:</label>
			<input type="email" id="newEmail" name="newEmail">
			<label for="newUsername">Nuovo Nome Utente:</label>
			<input type="text" id="newUsername" name="newUsername">
			<label for="newPassword">Nuova <span lang="en">Password</span>:</label>
			<input type="password" id="newPassword" name="newPassword">
			<input type="checkbox" onclick="toogleView('newPassword')">Mostra <span lang="en">Password</span>
			<label for="confirmNewPassword">Conferma Nuova <span lang="en">Password</span>:</label>
			<input type="password" id="confirmNewPassword" name="confirmNewPassword">
			<input type="checkbox" onclick="toogleView('confirmNewPassword')">Mostra <span lang="en">Password</span>
			<label for="oldPassword">Vecchia <span lang="en">Password</span>:</label>
			<input type="password" id="oldPassword" name="oldPassword" required>
			<input type="checkbox" onclick="toogleView('oldPassword')">Mostra <span lang="en">Password</span>
			<div>
				<input type="button" data-button-kind="modificaCredenziali" value="Annulla">
				<input type="submit" value="Salva Modifiche">
			</div>
		</form>`;

	let popUpEditProject = `<h2>Modifica Progetto</h2>
		<div id="modifyProjectError" class="hidden">{{ ModifyProjectError }}</div>
		<form id="modificaProgettoForm" action="/project/modify">
			<label for="inputNewNomeProgetto">Nuovo Nome Progetto:</label>
			<input type="text" id="newNewNomeProgetto" name="newNomeProgetto">
			<label for="inputNewDescrizioneProgetto">Nuova Descrizione:</label>
			<textarea id="newDescrizioneProgetto" name="newDescrizioneProgetto"></textarea>
			<input type="button" data-button-kind="editProject" value="Annulla">
			<input type="submit" value="Salva Modifiche">
		</form>`;

	let popupDeleteProject = `<h2>Conferma Eliminazione Progetto</h2>
	<div id="deleteProjectError" class="hidden">{{ DeleteProjectError }}</div>
	<form id="eliminaProgettoForm" action="/project/delete">
		<label for="inputPassword">Inserisci la <span lang="en">Password</span>:</label>
		<input type="password" id="checkPassword" name="checkPassword" required>
		<input type="checkbox" onclick="toogleView('checkPassword')">Mostra <span lang="en">Password</span>
		<div>
			<input type="button" data-button-kind="deleteProject" value="Annulla">
			<input type="submit" value="Conferma Eliminazione">
		</div>
	</form>`;

	let popUpDisjoinProject = `<h2>Conferma Abbandono Progetto</h2>
		<div id="disjoinProjectError" class="hidden">{{ DisjoinProjectError }}</div>
		<form id="abbandonaProgettoForm" action="/project/disjoin">
			<label for="inputPassword">Inserisci la <span lang="en">Password</span>:</label>
			<input type="password" id="checkPassword" name="checkPassword" required>
			<input type="checkbox" onclick="toogleView('checkPassword')">Mostra <span lang="en">Password</span>
			<div>
				<input type="button" data-button-kind="disjoinProject" value="Annulla">
				<input type="submit" value="Conferma Abbandono">
			</div>
		</form>`;
	//<input list="tags-datalist" id="newTag" name="newTag">
	let popupNewTransaction = `<h2>Registra una Nuova Transazione</h2>
		<form id="nuovoMovimento" action="/movimento/new">
			<label for="newData">Data:</label>
			<input type="date" id="newData" name="newData" required>
			<label for="newImporto">Importo (€):</label>
			<input type="number" id="newImporto" name="newImporto" step="0.01" required>
			<label for="newTag"><span lang="en">Tag</span>:</label> -->
			<select id="newTag" name="newTag">
				<option value=""></option>
				<option value="volvo">Volvo</option>
				<option value="saab">Saab</option>
				<option value="opel">Opel</option>
				<option value="audi">Audi</option>
			</select>
			<!-- Datalist per i tag -->
			<datalist id="tags-datalist">
			</datalist>
			<label for="newDescrizione">Descrizione:</label>
			<input type="text" id="newDescrizione" name="newDescrizione">
			<input type="button" data-button-kind="newTransaction" value="Annulla">
			<input type="submit" value="Registra Transazione">
		</form>`;

	let popupEditTransaction = `<h2>Modifica una Transazione</h2>
		<form id="modificaMovimento" action="/movimento/modify">
			<input type="number" name="transactionId" value="{{ tr-id }}" class="hidden">
			<label for="editData">Data:</label>
			<input type="date" id="editData" name="editData">
			<label for="editImporto">Importo (€):</label>
			<input type="number" id="editImporto" name="editImporto" step="0.01">
			<label for="editTag"><span lang="en">Tag</span>:</label>
			<select id="editTag" name="editTag">
				<option value="volvo">Volvo</option>
				<option value="saab">Saab</option>
				<option value="opel">Opel</option>
				<option value="audi">Audi</option>
			</select>
			<!-- Datalist per i tag -->
			<datalist id="tags-datalist">
			</datalist>
			<label for="editDescrizione">Descrizione:</label>
			<input type="text" id="editDescrizione" name="editDescrizione">
			<input type="button" data-button-kind="editTransaction" value="Annulla">
			<input type="submit" value="Registra Transazione">
		</form>`;

	let popupDeleteTransaction = `<h2>Conferma Eliminazione Transazione</h2>
		<form id="eliminaMovimento" action="/movimento/delete">
			<input type="number" name="transactionId" value="{{ tr-id }}" class="hidden">
			<label for="checkPassword">Inserisci la <span lang="en">Password</span>:</label>
			<input type="password" id="checkPassword" name="checkPassword" required>
			<input type="checkbox" onclick="toogleView('checkPassword')">Mostra <span lang="en">Password</span>
			<input type="button" data-button-kind="deleteTransaction" value="Annulla">
			<input type="submit" value="Conferma Eliminazione">
		</form>`;

	let popUpModificaTag = `<h2>Modifica tag</h2>
		<form id="modificaTagForm" action="/tag/modify">
		 	<input type="number" name="tag_id" value="{{ tag-id }}" class="hidden">
			<label for="new_name">Nuovo nome <span lang="en">tag</span>:</label>
			<input id="nomeTag" name="new_name">
			<label for="new_description">Nuova descrizione:</label>
			<input type="text" id="newDescrizione" name="new_description">
			<input type="button" data-button-kind="modificaTag" value="Annulla">
			<input type="submit" value="Modifica">
		</form>`;

	let popUpCreaTag = `<h2>Crea tag</h2>
		<form id="creaTagForm" action="/tag/create">
		 	<!-- <input type="number" name="project_id" value="{{ proj-id }}" class="hidden"> -->
			<label for="new_name">Nome:</label>
			<input id="nomeTag" name="new_name">
			<label for="new_description">Descrizione:</label>
			<input type="text" id="newDescrizione" name="new_description">
			<input type="button" data-button-kind="creaTag" value="Annulla">
			<input type="submit" value="Crea">
		</form>`;

	let diz = {
		accedi: popUpAccedi,
		registrati: popUpRegistrati,
		newProject: popUpNewProject,
		modificaCredenziali: popUpModifyCredentials,
		editProject: popUpEditProject,
		deleteProject: popupDeleteProject,
		disjoinProject: popUpDisjoinProject,
		newTransaction: popupNewTransaction,
		editTransaction: popupEditTransaction,
		deleteTransaction: popupDeleteTransaction,
		modificaTag: popUpModificaTag,
		creaTag: popUpCreaTag
	};

	document.body.addEventListener("click", function(event) {
		// Check if the clicked element is a button
		if (event.target.tagName === "INPUT") {
			// Show an alert with the ID of the clicked button

			let id = event.target.dataset.buttonKind;
			//if(id == "newTransaction") {mostra le option in popupNewTransaction}
			if (id == null) {
				return;
			} else {
				document.getElementById(id).classList.toggle("hidden");
				document.getElementById(id).classList.toggle("allert");
			}
			if (document.getElementById(id).classList.contains("hidden")) {
				const focusableElements = document.querySelectorAll(
					"a, button, input, textarea, select, [tabindex]"
				);
				focusableElements.forEach((element) => {
					element.removeAttribute("tabindex");
					element.classList.toggle("overlay");
				});
				document.getElementById(id).innerHTML = ``;
			} else {
				const focusableElements = document.querySelectorAll(
					"a, button, input, textarea, select, [tabindex]"
				);
				focusableElements.forEach((element) => {
					element.setAttribute("tabindex", "-1");
					element.classList.toggle("overlay");
				});

				if (id === "editTransaction") {
					let content = popupEditTransaction.toString();
					content = content.replace(
						"{{ tr-id }}",
						event.target.dataset.transazioneIndex
					);
					diz[id] = content;
				}
				else if (id === "deleteTransaction") {
					let content = popupDeleteTransaction.toString();
					content = content.replace(
						"{{ tr-id }}",
						event.target.dataset.transazioneIndex
					);
					diz[id] = content;
				}
				else if (id === "modificaTag") {
					let content = popUpModificaTag.toString();
					content = content.replace(
						"{{ tag-id }}",
						event.target.dataset.tagIndex
					);
					diz[id] = content;
				}
				// else if (id === "creaTag") {
				// 	let content = popUpCreaTag.toString();
				// 	content = content.replace(
				// 		"{{ proj-id }}",
				// 		event.target.dataset.projectIndex
				// 	);
				// 	diz[id] = content;
				// }
				// aggiungere gli id per la pagina dei tag.

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
		makePopUpAppear("success", "Testo copiato negli appunti!");
	}).catch(function(error) {
		makePopUpAppear("error", error);
	});
}

function openProjectPage(link) {
	window.location = `/page_project?link=${link}`;
}

function makePopUpAppear(id, message) {
	let popUpDiv = document.createElement("div");
	popUpDiv.id = id;
	popUpDiv.innerHTML = message;
	document.body.appendChild(popUpDiv);

	setTimeout(() => {
		document.body.removeChild(popUpDiv);
	}, 3000);
}

function post_request(url, body) {
	fetch(url, { method: "POST", body: JSON.stringify(body) })
		.then(async (data) => {
			if (!data.ok) {
				throw await data.json();
			}
			data = await data.json();

			let params = new URLSearchParams({
				redirect_message: data["message"]
			});
			const redirect = data["redirect"];
			if (redirect && redirect !== "") {
				let page = `${redirect}`;
				if (redirect.includes("?")) { // redirezione all'interno della pagina project e nella pagina dei tag.
					page += `&${params.toString()}`;
				} else {
					page += `?${params.toString()}`; // redirezione in tutti gli altri casi.
				}
				window.location.href = page;
			}
			makePopUpAppear("success", data.message);
		})
		.catch((err) => {
			console.log(err);
			makePopUpAppear("error", err.error);
		});
}

function postRequest(event) {
	data = Object.fromEntries(new FormData(event.target).entries());

	const urlString = window.location.href;
	const url = new URL(urlString);
	const upar = url.searchParams;
	console.log(upar);

	upar.forEach((value, key) => {
		const decodedKey = decodeURIComponent(key);
		const decodedValue = decodeURIComponent(value);
		data[decodedKey] = decodedValue;
	});

	post_request(event.target.action, data);
}

function joinProject() {

	if (validaAccess()) {
		const urlString = window.location.href;
		const url = new URL(urlString);
		const params = url.searchParams;

		const datas = {
			link: params.get('link'),
		};

		post_request('/project/join', datas);
	} else {
		makePopUpAppear("error", "Devi fare prima il Login");
	}
}

function toogleView(name = "password") {
	var elements = document.getElementsByName(name);
	for (var i = 0; i < elements.length; i++) {
		if (elements[i].type === "password") {
			elements[i].type = "text";
		} else {
			elements[i].type = "password";
		}
	}
}
