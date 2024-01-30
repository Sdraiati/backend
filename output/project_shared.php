<!-- title: Shared Project -->
<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> {{ Title }} </title>
	<base href="/backend/" />
	<meta name="description" content="un sito per mostrare cose">
	<meta name="keywords" content="sito, cose, dati, UN BEL GRAFICONE A TORTA">
	<link rel="stylesheet" type="text/css" href="index.css">
</head>


<body>
<nav>
	<div class="Logo">
		<a href="index.html"><img src="assets/img/logo.jpeg" alt="logo"></a>
	</div>
	<div class="Login">
		<ul class="login-list">
			<li><button data-button-kind="accedi">Accedi</button></li>
			<li><button data-button-kind="registrati">Registrati</button></li>
			<li class="hidden"><a href="account_home.html" id="utente">Utente</a></li>
		</ul>
	</div>
</nav>

<section id="accedi" class="hidden">
	<h2>Login</h2>
	<form id="loginForm" action="javascript:void(0)">
		<label for="loginEmail">Email:</label>
		<input type="email" id="loginEmail" name="email" required autocomplete="email">
		<label for="loginPassword">Password:</label>
		<input type="password" id="loginPassword" name="password" required autocomplete="current-password">
		<button type="button" data-button-kind="accediHide">Annulla</button>
		<button type="submit">Accedi</button>
	</form>
</section>

<section id="registrati" class="hidden">
	<h2>Registrazione</h2>
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
		<button type="button" data-button-kind="registratiHide">Annulla</button>
		<button type="submit">Registrati</button>
	</form>
</section>

<script type="module" src="assets/js/nav.js"></script>


	<header>
		<h1>Shared Project - {{ Project Name }}</h1>
	</header>

	<canvas id="line-chart-canvas" class="line-chart-container"></canvas>
<!-- Tabella delle transazioni -->
<section>
	<h2>Tabella delle Transazioni</h2>
	<button data-button-kind="newTransaction">Nuova Transazione</button>
	<!-- Inserisci qui la tabella delle transazioni -->
	<table id="transazioniTable">
		<!-- Intestazione della tabella -->
		<thead>
			<tr>
				<th>Data</th>
				<th>Costo (€)</th>
				<th>Tag</th>
				<th>Descrizione</th>
			</tr>
		</thead>
		<!-- Corpo della tabella -->
		<tbody>
		</tbody>
	</table>
</section>

<!-- Registra una Nuova Transazione -->
<section id="newTransaction" class="hidden">
	<h2>Registra una Nuova Transazione</h2>
	<form id="newTransactionForm" action="javascript:void(0)">
		<label for="newData">Data:</label>
		<input type="date" id="newData" name="data" required>
		<label for="newImporto">Importo:</label>
		<input type="number" id="newImporto" name="importo" step="0.01" required>
		<label for="newTag">Tag:</label>
		<input list="tags-datalist" id="newTag" name="tag" required>
		<!-- Datalist per i tag -->
		<datalist id="tags-datalist">
		</datalist>
		<label for="newDescrizione">Descrizione:</label>
		<input type="text" id="newDescrizione" name="descrizione">
		<button type="button" data-button-kind="newTransactionHide">Annulla</button>
		<button type="submit" id="submitNewTransaction">Registra Transazione</button>
	</form>
</section>

<!-- Modifica Transazione -->
<section id="editTransaction" class="hidden">
	<h2>Modifica Transazione</h2>
	<form id="editTransactionForm" action="javascript:void(0)">
		<label for="editData">Nuova Data:</label>
		<input type="date" id="editData" name="data">
		<label for="editCosto">Nuovo Importo (€):</label>
		<input type="number" id="editCosto" name="costo" step="0.01">
		<label for="editTag">Nuovo Tag:</label>
		<input list="tags-datalist" id="editTag" name="tag" required>
		<label for="editDescrizione">Nuova Descrizione:</label>
		<input type="text" id="editDescrizione" name="descrizione">
		<div class="form-buttons">
			<button type="button" id="deleteTransazioneButton">Elimina Transazione</button>
			<button type="button" data-button-kind="editTransactionHide">Annulla</button>
			<button type="submit" id="submitEditTransaction">Salva Modifiche</button>
		</div>
	</form>
</section>

<script type="module" src="assets/js/transazioni_list.js"></script>

<footer class="message-footer">
	<button type="button" data-button-kind="joinProject">Partecipa</button>
</footer>

<section id="joinProject" class="hidden">
	<h1>Partecipa al progetto</h1>
	<form id="joinProjectForm" action="javascript:void(0)">
		<div class="form-buttons">
			<button type="button" data-button-kind="joinProjectHide">Annulla</button>
			<button type="submit" id="submitJoinProject">Partecipa</button>
		</div>
</section>


</body>
<script src="assets/js/modifica.js"></script>

</html>
