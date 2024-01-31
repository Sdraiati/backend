function update_transazioni_table(transazioni) {
	// Seleziona l'elemento tbody della tua tabella
	let tbody = document.querySelector("#transazioniTable tbody")

	// Cancella tutte le righe esistenti in tbody
	tbody.innerHTML = ''

	transazioni.forEach((transazione) =>
		tbody.appendChild(transazione.toRow())
	)
}

export { update_transazioni_table }

let selected_transaction = null

document.addEventListener("DOMContentLoaded", function() {
	// update selected_transaction when a button is clicked
	document.body.addEventListener("click", function(event) {
		// Check if the clicked element is a button
		if (event.target.tagName === "BUTTON" && event.target.dataset.transazioneIndex != null) {
			selected_transaction = event.target.dataset.transazioneIndex
			documement.getElementById("editId").value = selected_transaction
		}
	});

	// Event handler per il pulsante "Elimina Transazione" del form di Modifica Transazione
	document.getElementById('deleteTransazioneButton').addEventListener('click', function() {
		let url = new URL(window.location.href)
		let project_id = parseInt(url.searchParams.get("id"))
		options = {
			method: "POST",
			body: JSON.stringify({ id: selected_transaction, id_progetto: project_id }),
		}
		fetch('api/progetto/elimina_movimento.php', options)
			.then(async (_) => true)
			.catch((error) => {
				console.log(error)
			})
	})
});

