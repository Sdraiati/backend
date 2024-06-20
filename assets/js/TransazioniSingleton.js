import { Transazione } from "./transazione.js"
import { rebaseUrl } from "./modifica.js"

const ms_per_day = 1000 * 60 * 60 * 24

class TransazioniSingleton {
	static observers_fn = []
	static tags = []
	static end = new Date()
	static begin = new Date(TransazioniSingleton.end.getTime() - 30 * ms_per_day)

	/** Restituisce un array di oggetti Transazione
	 * setta transazioni in sessionStorage
	 */
	static async fetch() {
		let project_id = get_project_id()
		let options = {
			method: "POST",
			body: JSON.stringify({ project_id: project_id }),
		}

		fetch(rebaseUrl(`movimento/get`), options)
			.then(async response => {
				if (response.ok) {
					let data = await response.json()
					return data
				} else {
					throw new Error("Errore nella richiesta")
				}
			})
			.then((response) => {
				sessionStorage.setItem(`${project_id}`, JSON.stringify(response))
				return response
			})
	}

	/** Restituisce un array di oggetti Transazione
	 * @returns {Promise<Transazione[]>} Array di oggetti Transazione dal server e setta
	 * transazioni in sessionStorage
	 */
	static async get_all() {
		let project_id = get_project_id()
		let transazioni = []
		if (sessionStorage.getItem(`${project_id}`) == null) {
			transazioni = await TransazioniSingleton.fetch()
		} else {
			transazioni = JSON.parse(sessionStorage.getItem(`${project_id}`))
		}
		transazioni = transazioni.map((obj) => Transazione.fromJsonObj(obj))
		return transazioni
	}

	/** Restituisce un array di oggetti Transazione
	 * filtrati per tag, data di inizio e data di fine
	 * @returns {Promise<Transazione[]>}
	 */
	static async get() {
		let transazioni = await TransazioniSingleton.get_all()

		if (TransazioniSingleton.tags.length > 0) {
			transazioni = transazioni.filter((transazione) => {
				return TransazioniSingleton.tags.includes(transazione.tag)
			})
		}

		return transazioni.filter((transazione) => {
			return (transazione.data >= TransazioniSingleton.begin && transazione.data <= TransazioniSingleton.end)
		})
	}

	static setPeriod(days) {
		TransazioniSingleton.begin = new Date(TransazioniSingleton.end.getTime() - days * ms_per_day)
		TransazioniSingleton.update()
	}

	static nextPeriod(flag) {
		let period = TransazioniSingleton.end.getTime() - TransazioniSingleton.begin.getTime()
		if (flag) {
			TransazioniSingleton.begin = TransazioniSingleton.end
			TransazioniSingleton.end = new Date(TransazioniSingleton.end.getTime() + period)
		} else {
			TransazioniSingleton.end = TransazioniSingleton.begin
			TransazioniSingleton.begin = new Date(TransazioniSingleton.begin.getTime() - period)
		}
		TransazioniSingleton.update()
	}

	static setTag(tag) {
		if (!TransazioniSingleton.tags.includes(tag)) {
			TransazioniSingleton.tags.push(tag)
			TransazioniSingleton.update()
		}
	}

	static removeTag(tag) {
		const index = TransazioniSingleton.tags.indexOf(tag)
		if (index > -1) {
			TransazioniSingleton.tags.splice(index, 1)
			TransazioniSingleton.update()
		}
	}

	/** Aggiunge un observer alla lista degli observer
	 * @param {function} fn - Funzione da aggiungere alla lista degli observer
	 */
	static addObserver(fn) {
		TransazioniSingleton.observers_fn.push(fn);
	}

	/** Update the observers
	 * @param {Transazione[]} transazioni - Array di oggetti Transazione
	 */
	static update() {
		TransazioniSingleton.get().then((transazioni) => {
			TransazioniSingleton.observers_fn.forEach((observer_fn) => {
				observer_fn(transazioni)
			})
		})
	}

	/** Restituisce l'intervallo di tempo
	 * @returns {{begin: Date, end: Date}} Intervallo di tempo
	 */
	static getPeriod() {
		return { begin: TransazioniSingleton.begin, end: TransazioniSingleton.end }
	}
}

function get_project_id() {
	let url = new URL(window.location.href)
	return parseInt(url.searchParams.get("project_id"))
}

export { TransazioniSingleton }
