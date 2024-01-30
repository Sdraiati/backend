<?php
include "../api/config/database.php";
?>

<?php
$project_id = $_GET['id'];
$sql = "SELECT * FROM progetto WHERE progetto.id = $project_id;";
$result = mysqli_query($conn, $sql);
$project = mysqli_fetch_assoc($result);

echo "<header>
	<h1>" . $project['nome'] . "</h1>";
?>

	<button type="button" data-button-kind="editProject">Modifica Progetto</button>
	<button type="button" data-button-kind="shareProject">Condividi Progetto</button>
</header>

<!-- Modifica Progetto -->
<section id="editProject" class="hidden">
	<h2>Modifica Progetto</h2>
	<form id="editProjectForm" action="backend/api/progetto/modifica_progetto.php" method="post">
		<input type="hidden" name="idProgetto" value="<?php echo $project['id'] ?>">
		<label for="inputNewNomeProgetto">Nuovo Nome Progetto:</label>
		<input type="text" id="inputNewNomeProgetto" name="newNomeProgetto" placeholder="<?php echo $project['nome'] ?>" required>
		<label for="inputNewDescrizioneProgetto">Nuova Descrizione:</label>
		<textarea id="inputNewDescrizioneProgetto" name="newDescrizioneProgetto" placeholder="<?php echo $project['descrizione'] ?>"></textarea>
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
	<form id="deleteProjectForm" action="backend/apiu/progetto/elimina_progetto.php" method="post">
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
