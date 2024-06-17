class Request {
	static async post(event) {
		return fetch(event.target.action, {
			method: 'POST',
			body: new FormData(event.target)
		}).then(async response => {
			if (response.ok) {
				return await response.json()
			} else {
				throw (await response.json()).error
			}
		})
	}

	static async get(url) {
		return fetch(url).then(async response => {
			if (response.ok) {
				return await response.json()
			} else {
				throw (await response.json()).error
			}
		})
	}
}
