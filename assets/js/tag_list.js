import { Transazione } from "./transazione.js"

function create_cell(text) {
	let cell = document.createElement("td")
	cell.textContent = text
	return cell
}

function create_button(index) {
	let button = document.createElement("button")
	button.textContent = "Modifica"
	button.setAttribute("data-button-kind", "editTag")
	button.setAttribute("data-tag-index", index)
	return button
}

function add_tag_table(parent, name, description, index) {
	let row = document.createElement("tr")
	row.appendChild(create_cell(name))
	row.appendChild(create_cell(description))
	row.appendChild(create_button(index))
	parent.appendChild(row)
}

async function get_tags() {
	let url = new URL(window.location.href)
	let id = parseInt(url.searchParams.get("id"))
	return await fetch("api/tag/visualizza_tag.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({ project_id: id, }),
	}).then(async response => response.json()
	).then(async data => {
		console.log(await data)
		return await data.map(t => {
			return {
				id: t.id,
				name: t.nome,
				descrizione: t.descrizione,
			}
		})
	}).catch(error => {
		console.error(error)
	})
}

get_tags().then(tags => {
	tags.forEach((tag, index) => {
		add_tag_table(document.querySelector("#tag-table tbody"), tag.name, tag.descrizione, index)
	})
})
