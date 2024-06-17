import { TransazioniSingleton } from './TransazioniSingleton.js';

function update_period(int) {
	TransazioniSingleton.setPeriod(int)
	document.getElementById("transazioni-precedenti").disabled = false
	document.getElementById("transazioni-periodo-1-mese").disabled = false
	document.getElementById("transazioni-periodo-6-mesi").disabled = false
	document.getElementById("transazioni-periodo-1-anno").disabled = false
}

document.getElementById("transazioni-precedenti").addEventListener("click", async function() {
	nextPeriod(false)
	let t = await TransazioniSingleton.get_all()
	if (t.filter((transazione) => transazione.data < getPeriod().begin).length == 0)
		document.getElementById("transazioni-precedenti").disabled = true
	document.getElementById("transazioni-successive").disabled = false
})

document.getElementById("transazioni-periodo-1-mese").addEventListener("click", function() {
	update_period(30)
	document.getElementById("transazioni-periodo-1-mese").disabled = true
})

document.getElementById("transazioni-periodo-6-mesi").addEventListener("click", function() {
	update_period(180)
	document.getElementById("transazioni-periodo-6-mesi").disabled = true
})

document.getElementById("transazioni-periodo-1-anno").addEventListener("click", function() {
	update_period(365)
	document.getElementById("transazioni-periodo-1-anno").disabled = true
})

document.getElementById("transazioni-successive").addEventListener("click", function() {
	nextPeriod(true)
	if (new Date() <= getPeriod().end) {
		document.getElementById("transazioni-successive").disabled = true
	}
	document.getElementById("transazioni-precedenti").disabled = false
})
