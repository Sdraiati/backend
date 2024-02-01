<!-- <title>Account Page</title> -->
<?php
	include "scripts/generate_header.php";

	generate_header("account_home");
?>

	<?php

	echo "<header>
		<h1>Benvenuto/a " . $_SESSION["username"] . "</h1>
	</header> ";

	?>

	<main>
<!-- Informazioni dell'account -->
<section>
	<h2>Informazioni dell'Account</h2>
	<ul>
		<li>Nome Utente: <span id="username"> <?php echo $_SESSION["username"] ?> <span></li>
		<li>Email: <span id="email"> <?php echo $_SESSION["email"] ?> </span></li>
	</ul>
	<button data-button-kind="modificaCredenziali">Modifica Credenziali</button>
</section>

<!-- Modifica informazioni dell'account -->
<section id="modificaCredenziali" class="allert">
	<h2>Modifica informazioni dell'account</h2>
	<form id="modificaCredenzialiForm" action="api/utente/aggiorna_utente.php" method="post">
		<label for="newEmail">Nuova Email:</label>
		<input type="email" id="newEmail" name="email" autocomplete="email" value="<?php echo $_SESSION["email"] ?>">
		<label for="newUsername">Nuovo Nome Utente:</label>
		<input type="text" id="newUsername" name="username" autocomplete="username" value="<?php echo $_SESSION["username"] ?>">
		<label for="newPassword">Nuova Password:</label>
		<input type="password" id="newPassword" name="password">
		<label for="confirmNewPassword">Conferma Nuova Password:</label>
		<input type="password" id="confirmNewPassword" name="confirm_password">
		<label for="oldPassword">Vecchia Password:</label>
		<input type="password" id="oldPassword" name="old_password" required>
		<button type="button" data-button-kind="modificaCredenzialiHide">Annulla</button>
		<button type="submit">Salva Modifiche</button>
	</form>
</section>

<script type="module" src="assets/js/account_info.js"></script>

<?php
    include 'api/config/database.php';
?>
<!-- Elenco dei progetti -->
<section>
	<h2>Elenco dei Progetti</h2>
	<button data-button-kind="newProject">Nuovo Progetto</button>
	<ul>
<?php
$email = sha1($_SESSION['email']);
$query = "SELECT progetto.id, progetto.nome
			FROM progetto JOIN progetto_utente ON progetto.id = progetto_utente.id_progetto
			WHERE progetto_utente.email = '$email'";

$result = mysqli_query($conn, $query);
if ($result) {
	$array = mysqli_fetch_all($result, MYSQLI_ASSOC);
	foreach ($array as $row) {
		$id = $row['id'];
		$nome = $row['nome'];
		echo "<li><a href='project_home.php?id=$id'>$nome</a></li>";
	}
}
?>
	</ul>
</section>

<!-- Crea un Nuovo Progetto -->
<section id="newProject" class="allert">
	<h2>Crea un Nuovo Progetto</h2>
	<form id="newProjectForm" action="api/progetto/crea_progetto.php" method="post">
		<label for="inputNomeProgetto">Nome Progetto:</label>
		<input type="text" id="inputNomeProgetto" name="nome" required>
		<label for="inputDescrizioneProgetto">Descrizione:</label>
		<textarea id="inputDescrizioneProgetto" name="descrizione" required></textarea>
		<div class="form-buttons">
			<button type="button" data-button-kind="newProjectHide">Annulla</button>
			<button type="submit" id="submitNewProject">Crea Progetto</button>
		</div>
	</form>
</section>

	</main>
<footer>
	<div class="footer-list">
		<h3>Prodotto</h3>
		<ul>
			<li><a href="account_home.php">I Miei Progetti</a></li>
			<li><a href="about_us.php">About Us</a></li>
		</ul>
	</div>
	<div class="footer-list">
		<h3>Risorse</h3>
		<ul>
			<li><a href="index.php">Homepage</a></li>
			<li><a href="release_notes.php">Release Notes</a></li>
			<li><a href="https://github.com/Sdraiati" target="_blank"> <img src="assets/img/github-mark-white.png"
						id="github-mark"> GitHub </a></li>
		</ul>
	</div>
</footer>

</body>

</html>
