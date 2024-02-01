document.addEventListener("DOMContentLoaded", function(_) {
	document.body.addEventListener("click", function(event) {
		// Check if the clicked element is a button
		if (event.target.tagName === "BUTTON") {
			// Show an alert with the ID of the clicked button
			let id = event.target.dataset.buttonKind
			if (id == null) {
				return
			} else if (id.endsWith("Hide")) {
				id = id.replace("Hide", "")
				document.getElementById(id).style.display = "none"
			} else {
				document.getElementById(id).style.display = "flex"
			}
		}
	});
})
