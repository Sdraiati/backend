import { TransazioniSingleton } from './TransazioniSingleton.js';

function update_period(int) {
	TransazioniSingleton.setPeriod(int)
	document.getElementById("transazioni-precedenti").classList.remove("disabled-button");
	document.getElementById("transazioni-periodo-1-mese").classList.remove("disabled-button");
	document.getElementById("transazioni-periodo-6-mesi").classList.remove("disabled-button");
	document.getElementById("transazioni-periodo-1-anno").classList.remove("disabled-button");
}

document.getElementById("transazioni-precedenti").addEventListener("click", async function() {
	TransazioniSingleton.nextPeriod(false)
	let t = await TransazioniSingleton.get_all()
	if (t.filter((transazione) => transazione.data < TransazioniSingleton.getPeriod().begin).length == 0)
		document.getElementById("transazioni-precedenti").classList.add("disabled-button");
	document.getElementById("transazioni-successive").classList.remove("disabled-button");
})

document.getElementById("transazioni-periodo-1-mese").addEventListener("click", function() {
	update_period(30)
	document.getElementById("transazioni-periodo-1-mese").classList.add("disabled-button");
})

document.getElementById("transazioni-periodo-6-mesi").addEventListener("click", function() {
	update_period(180)
	document.getElementById("transazioni-periodo-6-mesi").classList.add("disabled-button");
})

document.getElementById("transazioni-periodo-1-anno").addEventListener("click", function() {
	update_period(365)
	document.getElementById("transazioni-periodo-1-anno").classList.add("disabled-button");
})

document.getElementById("transazioni-successive").addEventListener("click", function() {
	TransazioniSingleton.nextPeriod(true)
	if (new Date() <= TransazioniSingleton.getPeriod().end) {
		document.getElementById("transazioni-successive").classList.add("disabled-button");
	}
	document.getElementById("transazioni-precedenti").classList.remove("disabled-button");
})
let tags = document.querySelectorAll("#tag_sidebar input[type=\"button\"]");
tags.forEach((tag) => {
	tag.addEventListener("click", function() {
		if (tag.classList.contains("disabled-button")) {
			TransazioniSingleton.removeTag(tag.value);
			tag.classList.remove("disabled-button");
		} else {
			TransazioniSingleton.setTag(tag.value);
			tag.classList.add("disabled-button");
		}
	});
});
