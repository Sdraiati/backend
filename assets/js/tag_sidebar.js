import { Transazione } from "./transazione.js"

// Add the event listener to the form
let prev = null

document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("tag_sidebar").addEventListener("click", (event) => {
		if (event.target.type != "radio") return
		else if (prev == null) {
			prev = event.target
			Transazione.setTag(event.target.value)
		} else if (prev == event.target) {
			Transazione.setTag(null)
			prev = null
			event.target.checked = false
		} else {
			Transazione.setTag(event.target.value)
			prev = event.target
			return
		}
	})
})
