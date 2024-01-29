fetch('http://localhost/backend/api/utente/valida_utente.php', {
	method: 'POST',
	body: JSON.stringify({
        email: 'leonardo.basso02@gmail.com',
        username: 'bassupreme',
        password : 'leonardo1234'
	})
}).then((res) => console.log(res)).catch((err) => console.log(err));