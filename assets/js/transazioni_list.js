import { Transazione } from "./transazione.js"

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
		// Check if the clicked element is a button to edit a transaction
		if (event.target.tagName === "BUTTON" && event.target.dataset.transazioneIndex != null) {
			let project_id = get_project_id()
			let transazioni = JSON.parse(sessionStorage.getItem(`${project_id}`))
			let t = transazioni.find((transazione) => transazione.id === event.target.dataset.transazioneIndex)

			selected_transaction = event.target.dataset.transazioneIndex
			document.getElementById("editId").value = t.id
			document.getElementById("editData").value = dateToString(new Date(t.data))
			document.getElementById("editImporto").value = t.importo
			document.getElementById("editTag").value = t.tag
			document.getElementById("editDescrizione").value = t.descrizione
		}
	});

	// Event handler per il pulsante "Elimina Transazione" del form di Modifica Transazione
	document.getElementById('deleteTransazioneButton').addEventListener('click', function() {
		let url = new URL(window.location.href)
		let project_id = parseInt(url.searchParams.get("id"))
		console.log(project_id)
		let options = {
			method: "POST",
			body: JSON.stringify({
				id_transazione: selected_transaction,
				id_progetto: `${project_id}`
			}),
		}
		fetch('api/movimento/elimina_movimento.php', options)
			.then((response) => {
				if (response.ok) {
					Transazione.fetch()
					window.location.href = url
				}
			})
			.catch((error) => {
				console.log(error)
			})
	})

	document.getElementById('editTransazioneForm').addEventListener('submit', function(event) {
		event.preventDefault()
		let url = new URL(window.location.href)

		fetch(event.target.action, {
			method: event.target.method,
			body: new FormData(event.target),
		})
			.then((response) => {
				if (response.ok) {
					Transazione.fetch()
					window.location.href = url
				}
			})
			.catch((error) => {
				console.log(error)
			})
	})

	document.getElementById('newTransazioneForm').addEventListener('submit', function(event) {
		event.preventDefault()
		let url = new URL(window.location.href)

		fetch(event.target.action, {
			method: event.target.method,
			body: new FormData(event.target),
		})
			.then((response) => {
				if (response.ok) {
					Transazione.fetch()
					window.location.href = url
				}
			})
			.catch((error) => {
				console.log(error)
			})
	})
});

function get_project_id() {
	let url = new URL(window.location.href)
	return parseInt(url.searchParams.get("id"))
}

function dateToString(date) {
	let giorno = date.getDate()
	let mese = date.getMonth() + 1 // Mese inizia da 0, quindi aggiungiamo 1
	let anno = date.getFullYear()

	// Formatta la data nel formato "GG/MM/YYYY"
	let dataFormattata = anno + '-' + (mese < 10 ? '0' : '') + mese + '-' + (giorno < 10 ? '0' : '') + giorno
	return dataFormattata
}

Transazione.fetch()
Transazione.addObserver(update_transazioni_table)
Transazione.update()
