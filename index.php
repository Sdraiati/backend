<!-- <title>Home - Penny Wise</title> -->
<?php
	include "scripts/generate_header.php";

	generate_header("Home");
?>
<!--
<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> Home </title>
	<base href="/backend/" />
	<meta name="description" content="un sito per mostrare cose">
	<meta name="keywords" content="sito, cose, dati, UN BEL GRAFICONE A TORTA">
	<link href="index.css" rel="stylesheet" type="text/css" />
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
</nav>

<section id="accedi" class="hidden">
	<h2>Login</h2>
	<form id="loginForm" action="api/utente/valida_utente.php" method="POST">
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
	<form id="registratiForm" action="api/utente/crea_utente.php">
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
-->

<!--
<script type="module" src="assets/backend/js/nav.js"></script>
-->


	<header>
		<h1>Penny Wise</h1>
	</header>

	<main>
<!-- <title>Home - Penny Wise</title> -->
<section>
	<div>
		<img src="./screenshot.jpg" alt="Screenshot dell'homepage di Penny Wise">
        <p>Benvenuto su Penny Wise, la tua soluzione gratuita per gestire le finanze in modo efficace ed efficiente. Sia che tu stia cercando di risparmiare, pianificare per il futuro o semplicemente tenere traccia delle tue spese quotidiane, siamo qui per aiutarti.</p>
    </div>
</section>

<section>
	<h2>Cosa puoi fare con Penny Wise?</h2>
	<p>Con Penny Wise, hai a disposizione una serie di strumenti per gestire le tue finanze in modo intelligente:</p>
	<div class="grid-container">
		<div class="grid-item">
			<img src="./screenshot.jpg" alt = "inserimento di una transiazione">	
		</div>
		<div class="grid-item">
			<ul>
				<li><strong>Registra le transazioni:</strong> Registra spese ed entrate in modo rapido e accurato, fornendo una panoramica completa delle tue finanze.</li>
			</ul>
		</div>
		<div class="grid-item">
			<ul>
				<li><strong>Grafici intuitivi:</strong> Visualizza l'andamento generale delle tue finanze attraverso grafici chiari e comprensibili.</li>
				<li><strong>Retrospettive finanziarie:</strong> Effettua analisi retrospettive, migliorando la tua capacità di prendere decisioni finanziarie informate.</li>
			</ul>
		</div>
		<div class="grid-item">
			<img src="./screenshot.jpg" alt = "grafico dell'andamento patrimoniale">
		</div>
		<div class="grid-item">
			<img src="./screenshot.jpg" alt = "analisi delle spese suddivise per tag">
		</div>
		<div class="grid-item">
			<ul>
				<li><strong>Categorizzazione avanzata:</strong> Categorizza le tue transazioni assegnando tag personalizzati, semplificando la gestione e l'analisi delle tue spese.</li>
				<li><strong>Analisi dettagliata:</strong> Filtra e analizza le spese per categoria, monitorando la percentuale di spese per ogni tag. Ottieni una visione dettagliata dei tuoi consumi.</li>
			</ul>
		</div>
	</div>
	<div>
		<h2>Perché scegliere Penny Wise?</h2>
		<p>La nostra webapp è progettata pensando alle tue esigenze specifiche:</p>
		<ul>
			<li><strong>Facile da usare:</strong> Un'interfaccia utente intuitiva rende la registrazione delle transazioni e la navigazione nell'app un gioco da ragazzi.</li>
			<li><strong>Gratuita e accessibile:</strong> Penny Wise è completamente gratuito, garantendo a tutti l'accesso a uno strumento di gestione finanziaria di alta qualità.</li>
		</ul>
	</div>
</section>


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
