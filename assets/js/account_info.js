document.addEventListener('DOMContentLoaded', function() {
	document.getElementById('modificaCredenzialiForm')
		.addEventListener('submit', function(event) {
			let newPassword = document.getElementById('newPassword').value;
			let confirmNewPassword = document.getElementById('confirmNewPassword').value;

			if (newPassword !== confirmNewPassword) {
				document.getElementById("confirmNewPassword")
					.setCustomValidity("Le password non coincidono")
				event.preventDefault();
				return false;
			}
		});
})
