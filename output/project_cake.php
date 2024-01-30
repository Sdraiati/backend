<!-- <title>{{Project Name}}</title> -->
<!-- Riferimento al file JavaScript esterno per la generazione del line chart -->
<!-- <script src="line_chart_script.js"></script> -->
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

<!-- <title>{{Project Name}}</title> -->
<!-- Riferimento al file JavaScript esterno per la generazione del line chart -->
<!-- <script src="line_chart_script.js"></script> -->

<header>
	<h1>{{ Project Name }}</h1>
	<button type="button" data-button-kind="editProject">Modifica Progetto</button>
	<button type="button" data-button-kind="shareProject">Condividi Progetto</button>
</header>

<!-- Modifica Progetto -->
<section id="editProject" class="hidden">
	<h2>Modifica Progetto</h2>
	<form id="editProjectForm" action="javascript:void(0)">
		<label for="inputNewNomeProgetto">Nuovo Nome Progetto:</label>
		<input type="text" id="inputNewNomeProgetto" name="newNomeProgetto">
		<label for="inputNewDescrizioneProgetto">Nuova Descrizione:</label>
		<textarea id="inputNewDescrizioneProgetto" name="newDescrizioneProgetto"></textarea>
		<div class="form-buttons">
			<button type="button" data-button-kind="deleteProject">Elimina Progetto</button>
			<button type="button" data-button-kind="editProjectHide">Annulla</button>
			<button type="submit" id="submitEditProject">Salva Modifiche</button>
		</div>
	</form>
</section>

<!-- Elimina Progetto -->
<section id="deleteProject" class="hidden">
	<h2>Conferma Eliminazione Progetto</h2>
	<form id="deleteProjectForm" action="javascript:void(0)">
		<label for="inputPassword">Inserisci la Password:</label>
		<input type="password" id="inputPassword" name="password" required>
		<div class="form-buttons">
			<button type="button" data-button-kind="deleteProjectHide">Annulla</button>
			<button type="submit" id="submitDeleteProject">Conferma Eliminazione</button>
		</div>
	</form>
</section>

<!-- Condividi Progetto -->
<section id="shareProject" class="hidden">
	<h2>Condividi Progetto</h2>
	<form id="linkForm">
		<input type="text" id="linkField" value="https://example.com" readonly>
		<button type="button" data-button-kind="shareProjectHide">Annulla</button>
		<button type="button" id="copyShareProject">Copy Link</button>
	</form>
</section>


	<!-- Canvas per il line chart -->
	<canvas id="cake-chart-canvas" class="cake-chart-container"></canvas>
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

<!-- Filtri per tag -->
<aside class="filtri-tag-container">
	<a href="project_cake.html">Vai al Grafico a Torta</a>
	<h2>Filtri per Tag</h2>
	<!-- Inserisci qui i filtri per tag -->
	<form id="tag_sidebar">
	</form>

	<a href="tag_page.html">Vai alla Pagina dei Tag</a>
</aside>

<script type="module" src="assets/js/tag_sidebar.js"></script>

<!-- Partecipanti -->
<aside class="partecipanti-container">
	<h2>Partecipanti</h2>
	<!-- Inserisci qui l'elenco dei partecipanti -->
	<ul id="partecipanti-list">
	</ul>
</aside>

<script type="module" src="assets/js/partecipanti_sidebar.js"></script>

<footer>
	<div class="footer-list">
		<h3>Prodotto</h3>
		<ul>
			<li><a href="account_home.html">I Miei Progetti</a></li>
			<li><a href="about_us.html">About Us</a></li>
		</ul>
	</div>
	<div class="footer-list">
		<h3>Risorse</h3>
		<ul>
			<li><a href="index.html">Homepage</a></li>
			<li><a href="release_notes.html">Release Notes</a></li>
			<li><a href="https://github.com/Sdraiati" target="_blank"> <img src="assets/img/github-mark-white.png"
						id="github-mark"> GitHub </a></li>
		</ul>
	</div>
</footer>

<script src="assets/js/modifica.js"></script>
<script src="assets/js/footerColors.js"></script>

</body>

</html>
