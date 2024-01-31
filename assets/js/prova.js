async function h() {
	let project_id = get_project_id()
	let options = {
		method: "POST",
		body: JSON.stringify({ id_progetto: project_id }),
	}

	console.log(options)
	fetch(`api/progetto/movimenti_progetto.php`, options)
		.then(async (response) => {
			console.log(response)
			if (response.ok) {
				let data = await response.json()
				console.log(data)
			}
		})
}

function get_project_id() {
	let url = new URL(window.location.href)
	return parseInt(url.searchParams.get("id"))
}

h()
