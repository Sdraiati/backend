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
