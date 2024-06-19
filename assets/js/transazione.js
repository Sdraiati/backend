class Transazione {
	/** Crea un oggetto Transazione
	* @param {Date} data - Oggetto Date che rappresenta la data
	* @param {number} importo - Importo della transazione
	* @param {string} tag - Tag della transazione
	* @param {string} descrizione - Descrizione della transazione
	*/
	constructor(id, data, importo, tag, descrizione) {
		this.id = id
		this.data = data
		this.importo = importo
		this.tag = tag
		this.descrizione = descrizione
	}

	/** Restituisce una riga di una tabella
	* @param {number} index - Indice della transazione
	* @returns {HTMLTableRowElement} Riga della tabella
	*/
	toRow() {
		let newRow = document.createElement("tr")
		createCell(newRow, dateToString(this.data))
		createCell(newRow, this.importo.toFixed(2))
		createCell(newRow, this.tag)
		createCell(newRow, this.descrizione)
		createButtonCell(newRow, this.id, "Modifica", "editTransaction")
		createButtonCell(newRow, this.id, "Elimina", "deleteTransaction")
		return newRow
	}

	static fromJsonObj(obj) {
		return new Transazione(
			obj.id,
			new Date(obj.data),
			parseFloat(obj.importo),
			obj.tag,
			obj.descrizione
		)
	}
}

/** Crea una cella di una tabella
* @param {HTMLTableRowElement} row - Riga della tabella
* @param {string} text - Testo della cella
*/
function createCell(row, text) {
	let td = document.createElement("td")
	td.textContent = text
	row.appendChild(td)
}

/** Crea una cella di una tabella con un bottone
* @param {HTMLTableRowElement} row - Riga della tabella
* @param {number} index - Indice della transazione
*/
function createButtonCell(row, index, value, buttonKind) {
	let form = document.createElement("form")
	let td = document.createElement("td")
	let button = document.createElement("input")
	button.setAttribute("data-button-kind", buttonKind)
	button.setAttribute("data-transazione-index", index)
	button.setAttribute("type", "button")
	button.setAttribute("value", value)
	form.appendChild(button)
	td.appendChild(form)
	row.appendChild(td)
}

/** Restituisce una stringa che rappresenta la data
* @param {Date} date - Oggetto Date che rappresenta la data
* @returns {string} Stringa che rappresenta la data in formato "GG/MM/YYYY"
*/
function dateToString(date) {
	let giorno = date.getDate()
	let mese = date.getMonth() + 1 // Mese inizia da 0, quindi aggiungiamo 1
	let anno = date.getFullYear()

	// Formatta la data nel formato "GG/MM/YYYY"
	let dataFormattata = (giorno < 10 ? '0' : '') + giorno + '/' + (mese < 10 ? '0' : '') + mese + '/' + anno
	return dataFormattata
}

export { Transazione }
