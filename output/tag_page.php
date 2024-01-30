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
		<h1>{{ Project Name }} - Tag</h1>
	</header>

	<main>
<!-- tabella dei tag -->
<section>
	<h2>Tabella dei Tag</h2>
	<button data-button-kind="newTag">Nuovo Tag</button>

	<table id="tag-table">
		<thead>
			<tr>
				<th>Nome</th>
				<!-- <th>Colore</th> -->
				<th>Descrizione</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</section>

<section id="newTag" class="hidden" action="javascript:void(0)">
	<h2>Nuovo Tag</h2>
	<form>
		<label for="newTagName">Nome</label>
		<input type="text" id="newTagName" name="tagName" placeholder="Nome del Tag" required>
		<label for="newTagDescription">Descrizione</label>
		<textarea id="newTagDescription" name="tagDescription" placeholder="Descrizione del Tag" required></textarea>
		<button type="button" data-button-kind="newTagHide">Annulla</button>
		<button type="submit" id="submitNewTag">Salva</button>
	</form>
</section>

<section id="editTag" class="hidden" action="javascript:void(0)">
	<h2>Modifica Tag</h2>
	<form>
		<label for="editTagName">Nuovo Nome</label>
		<input type="text" id="editTagName" name="tagName" placeholder="Nome del Tag" required>
		<label for="editTagDescription">Nuova Descrizione</label>
		<textarea id="editTagDescription" name="tagDescription" placeholder="Descrizione del Tag" required></textarea>
		<button type="button" data-button-kind="editTagHide">Annulla</button>
		<button type="submit" id="submitEditTag">Salva</button>
	</form>
</section>

<script type="module" src="assets/js/tag_list.js"></script>

	</main>
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
