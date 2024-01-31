<!-- <title>{{Project Name}}</title> -->
<!-- Riferimento al file JavaScript esterno per la generazione del line chart -->
<!-- <script src="line_chart_script.js"></script> -->
<?php
	include "scripts/generate_header.php";


	generate_header("Home");
?>
<script type="module" src="assets/js/tag_sidebar.js"></script>
<?php
include "api/config/database.php";

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
		<tbody>
		</tbody>
	</table>
</section>

<!-- Registra una Nuova Transazione -->
<section id="newTransaction" class="hidden">
	<h2>Registra una Nuova Transazione</h2>
	<form id="newTransactionForm" action="backend/api/movimento/crea_movimento.php" method="post">
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
	<form id="editTransactionForm" action="backend/api/movimento/aggiorna_movimento.php" method="post">
		<input type="hidden" id="editId" name="id" readonly>
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

<?php
include "api/config/database.php";
?>

<!-- Filtri per tag -->
<aside class="filtri-tag-container">
	<a href="project_cake.html">Vai al Grafico a Torta</a>
	<h2>Filtri per Tag</h2>
	<form id="tag_sidebar">
<?php
$id = $_GET['id'];
$query = "SELECT tag.nome FROM tag
			WHERE tag.id_progetto = '$id'";
$result = mysqli_query($conn, $query);
if ($result) {
	$array = mysqli_fetch_all($result, MYSQLI_ASSOC);
	foreach ($array as $row) {
		$nome = $row['nome'];
		echo "<label for='$nome'>$nome</label>";
		echo "<input type='radio' id='$nome' name='$nome' value='$nome'>";
	}
}
?>
	</form>

	<a href="tag_page.php?id=
<?php 
echo $_GET['id'];
?>">Vai alla Pagina dei Tag</a>
</aside>

<?php
include "../api/config/database.php";
?>
<!-- Partecipanti -->
<aside class="partecipanti-container">
	<h2>Partecipanti</h2>
	<ul id="partecipanti-list">
<?php
	$id = isset($_GET['id']) ? $_GET['id'] : null;
	$sql = "SELECT utente.username 
				FROM (utente INNER JOIN progetto_utente 
					ON utente.email = progetto_utente.email) 
				WHERE progetto_utente.progetto_id = $id;";

	$result = mysqli_query($conn, $sql);
	if ($result) {
		$array = mysqli_fetch_all($result, MYSQLI_ASSOC);
		foreach ($array as $row) {
			echo "<li>" . $row['username'] . "</li>";
		}
	}
?>
	</ul>
</aside>

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
