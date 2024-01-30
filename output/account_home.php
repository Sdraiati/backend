<!-- <title>Account Page</title> -->
<?php
	include "../scripts/generate_header.php";

	generate_header("account_home");
?>

	<?php

	echo "<header>
		<h1>Benvenuto/a " . $_SESSION["username"] . "</h1>
	</header> ";

	?>

	<main>


	<!-- import account_info.html -->
	<?php
		include "../layout/account_info.php";
	?>
<!-- Elenco dei progetti -->
<section>
	<h2>Elenco dei Progetti</h2>
	<button data-button-kind="newProject">Nuovo Progetto</button>
	<!-- Inserisci qui l'elenco dei progetti, dinamicamente -->
	<ul id="project-list">
	</ul>
</section>

<!-- Crea un Nuovo Progetto -->
<section id="newProject" class="hidden">
	<h2>Crea un Nuovo Progetto</h2>
	<form id="newProjectForm" action="api/progetto/crea_progetto.php" >
		<label for="inputNomeProgetto">Nome Progetto:</label>
		<input type="text" id="inputNomeProgetto" name="nomeProgetto" required>
		<label for="inputDescrizioneProgetto">Descrizione:</label>
		<textarea id="inputDescrizioneProgetto" name="descrizioneProgetto" required></textarea>
		<div class="form-buttons">
			<button type="button" data-button-kind="newProjectHide">Annulla</button>
			<button type="submit" id="submitNewProject">Crea Progetto</button>
		</div>
	</form>
</section>

<script type="module" src="assets/js/project_list.js"></script>

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
