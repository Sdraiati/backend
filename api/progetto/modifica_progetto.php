<?php
include_once '../../api/config/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION['email'])) {
	redirect("page_not_found.php");
	exit();
}

$email = sha1($_SESSION['email']);
$id = $_POST["id_progetto"];
$nome = $_POST["nome_progetto"];
$descrizione = $_POST["descrizione_progetto"];

// check if the user is the owner of the project
$sql = "SELECT * FROM progetto_utente
			WHERE id_progetto = '$id'
			AND email = '$email'";

try {
$result = mysqli_query($conn, $sql);
} catch (Exception $e) {
	echo $e;
}

if (mysqli_num_rows($result) == 0) {
	header("location: /404.html");
	exit();
}

$sql = "UPDATE progetto 
		SET
			nome = \"$nome\",
			descrizione = \"$descrizione\"
		WHERE progetto.id = $id";

try {
$result = mysqli_query($conn, $sql);
} catch (Exception $e) {
	echo $e;
}

redirect("project_home.php?id=$id");

$conn->close();
?>
