<!-- Informazioni dell'account -->
<section>
	<h2>Informazioni dell'Account</h2>
	<ul>
		<li>Nome Utente: <span id="username"> <?php echo $_SESSION["username"] ?> <span></li>
		<li>Email: <span id="email"> <?php echo $_SESSION["email"] ?> </span></li>
	</ul>
	<button data-button-kind="modificaCredenziali">Modifica Credenziali</button>
</section>

<!-- Modifica informazioni dell'account -->
<section id="modificaCredenziali" class="hidden">
	<h2>Modifica informazioni dell'account</h2>
	<form id="modificaCredenzialiForm" action="api/utente/aggiorna_utente.php">
		<label for="newEmail">Nuova Email:</label>
		<input type="email" id="newEmail" name="newEmail" placeholder="<?php echo $_SESSION["email"] ?>">
		<label for="newUsername">Nuovo Nome Utente:</label>
		<input type="text" id="newUsername" name="newUsername" placeholder="<?php echo $_SESSION["username"] ?>">
		<label for="newPassword">Nuova Password:</label>
		<input type="password" id="newPassword" name="newPassword">
		<label for="confirmNewPassword">Conferma Nuova Password:</label>
		<input type="password" id="confirmNewPassword" name="confirmNewPassword">
		<label for="oldPassword">Vecchia Password:</label>
		<input type="password" id="oldPassword" name="oldPassword" required>
		<button type="button" data-button-kind="modificaCredenzialiHide">Annulla</button>
		<button type="submit" id="submitModificaCredenziali">Salva Modifiche</button>
	</form>
</section>

<!-- <script type="module" src="assets/js/account_info.js"></script> -->
<script type="module" src="assets/js/modifica.js"></script> 

