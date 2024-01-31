<?php
	include "../scripts/generate_header.php";

	generate_header("Home");
?>

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
// dovrebbe essere l'hash del progetto
$shared_project_id = $_GET['project_id'];
?>

<footer class="message-footer">
	<button type="button" data-button-kind="joinProject">Partecipa</button>
</footer>

<section id="joinProject" class="hidden">
	<h1>Partecipa al progetto</h1>
	<form id="joinProjectForm" action="backend/api/entra_nel_progetto.php" method="post">
		<input type="hidden" name="idProgetto" value="<?php echo $shared_project_id ?>">
		<div class="form-buttons">
			<button type="button" data-button-kind="joinProjectHide">Annulla</button>
			<button type="submit" id="submitJoinProject">Partecipa</button>
		</div>
</section>


</body>
<script src="assets/js/modifica.js"></script>

</html>
