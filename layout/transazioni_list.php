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
<section id="newTransaction" class="allert">
	<h2>Registra una Nuova Transazione</h2>
	<form id="newTransazioneForm" action="api/movimento/crea_movimento.php" method="post">
		<input type="hidden" name="id_progetto" value="<?php echo $project['id'] ?>" readonly>
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
<section id="editTransaction" class="allert">
	<h2>Modifica Transazione</h2>
	<form id="editTransazioneForm" action="api/movimento/aggiorna_movimento.php" method="post">
		<input type="hidden" name="id_progetto" value="<?php echo $project['id'] ?>" readonly>
		<input type="hidden" id="editId" name="id_transazione" readonly>
		<label for="editData">Nuova Data:</label>
		<input type="date" id="editData" name="data">
		<label for="editImporto">Nuovo Importo (€):</label>
		<input type="number" id="editImporto" name="importo" step="0.01">
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
