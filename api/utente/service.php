<?php
include_once '../config/database.php';
include_once '../config/lib.php';

function nuovo($email, $password, $username) {
	$hash_email = sha1($email);
	$hash_password = sha1($password);
	$sql = "INSERT INTO utente (email, username, password) VALUES (?, ?, ?)";

	$conn = connect();
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $hash_email, $username, $hash_password);

	if ($stmt->execute()) {
		ok("Utente creato con successo", null);
	} else {
		error("Errore durante la creazione dell'utente");
	}

	$stmt->close();
}

function valida($email, $password) {
	$hash_email = sha1($email);
	$hash_password = sha1($password);

	// query al db
	$sql = "SELECT * FROM utente WHERE email = ? and password = ?";
	$conn = connect();
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $hash_email, $hash_password);

	if (!$stmt->execute()) {
		error("Errore nella query");
	}

	$array = mysqli_fetch_all($stmt->get_result(), MYSQLI_ASSOC);

	if (count($array) == 0) {
		error("Email o password errati");
	}

	session_start();
	$_SESSION["email"] = $email;
	$_SESSION["username"] = $array[0]["username"];

	ok("Login effettuato", null);
}

function aggiorna($old_email, $email, $password, $username) {
	$hash_email = sha1($email);
	$hash_password = sha1($password);

	// query al db
	$sql = "UPDATE utente SET email = ?, username = ?, password = ? WHERE email = ?;";
	$conn = connect();
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssss", $hash_email, $username, $hash_password, $old_email);

	if (!$stmt->execute()) {
		error("Email già in uso");
	}

	$_SESSION["email"] = $email;
	$_SESSION["username"] = $username;
	ok("Account aggiornato", null);
}

?>
