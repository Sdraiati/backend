document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("sharingOption").addEventListener("click", function(event) {
		let link = document.getElementById("linkField");
		let url = new URL(window.location.href)
		let project_id = parseInt(url.searchParams.get("id"))

		const currentState = this.getAttribute('data-sharing-state');
		if (currentState === 'not-shared') {
			fetch("api/progetto/condividi_progetto.php",
				{
					method: "POST",
					body: JSON.stringify({
						"id_progetto": project_id
					})
				}).then(async response => {
					if (response.ok) {
						let data = await response.json()
						link.value = data.link
						event.target.innerHTML = "Interrompi condivisione"
						event.target.setAttribute('data-sharing-state', 'shared')
					} else { console.log("Errore nella richiesta di condivisione") }
				})
		} else {
			fetch("api/progetto/interrompi_condivisione.php",
				{
					method: "POST",
					body: JSON.stringify({
						"id_progetto": project_id
					})
				}).then(response => {
					if (!response.ok)
						console.log("Errore nella richiesta di condivisione")
				}).then(_ => {
					link.value = null;
					link.placeholder = "https://www.example.com";
					event.target.innerHTML = "Condividi progetto"
					event.target.setAttribute('data-sharing-state', 'not-shared')
				})
		}
	})

	document.getElementById('copyShareProject').addEventListener('click', function(_) {
		const linkField = document.getElementById('linkField');
		linkField.select();
		document.execCommand('copy');
		linkField.setSelectionRange(0, 0);
	});
})
