import { Transazione } from "./transazione.js"

function updateTransazioniTable(transazioni) {
	// Seleziona l'elemento tbody della tua tabella
	let tbody = document.querySelector("#transazioniTable tbody")

	// Cancella tutte le righe esistenti in tbody
	tbody.innerHTML = ''

	transazioni.forEach((transazione) =>
		tbody.appendChild(transazione.toRow())
	)
}

export { updateTransazioniTable }
