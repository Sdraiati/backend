import { TransazioniSingleton } from './TransazioniSingleton.js';

function update_period(int) {
	TransazioniSingleton.setPeriod(int)
	document.getElementById("transazioni-precedenti").disabled = false
	document.getElementById("transazioni-periodo-1-mese").disabled = false
	document.getElementById("transazioni-periodo-6-mesi").disabled = false
	document.getElementById("transazioni-periodo-1-anno").disabled = false
}

document.getElementById("transazioni-precedenti").addEventListener("click", async function() {
	TransazioniSingleton.nextPeriod(false)
	let t = await TransazioniSingleton.get_all()
	if (t.filter((transazione) => transazione.data < TransazioniSingleton.getPeriod().begin).length == 0)
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
	TransazioniSingleton.nextPeriod(true)
	if (new Date() <= TransazioniSingleton.getPeriod().end) {
		document.getElementById("transazioni-successive").disabled = true
	}
	document.getElementById("transazioni-precedenti").disabled = false
})

//prendo tutti i tasti il form con id tag_sidebar
let tags = document.querySelectorAll("#tag_sidebar input[type=\"button\"]")
tags.forEach((tag) => {
	tag.addEventListener("click", function() {
		let tag_name = tag.value
		TransazioniSingleton.setTag(tag_name)
	})
})