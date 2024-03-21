<?php
include_once '../config/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION['email'])) {
	redirect("resource_not_found.php");
	exit();
}


$id = filter_var($_POST['id_progetto'], FILTER_SANITIZE_NUMBER_INT);
$password = sha1($_POST["password"]);
$email = sha1($_SESSION['email']);

// check if the user is the owner of the project
$sql = "SELECT * FROM progetto_utente
		JOIN utente ON utente.email = progetto_utente.email
			WHERE id_progetto = '$id'
			AND utente.email = '$email'
			AND password = '$password'";

try {
$result = mysqli_query($conn, $sql);
} catch (Exception $e) {
	echo $e;
}

if (mysqli_num_rows($result) == 0) {
	redirect("resource_not_found.php");
	exit();
}


// Prepare the SQL query
$sql = "
	DELETE FROM progetto_utente WHERE id_progetto = '$id';
	DELETE FROM movimento WHERE id_progetto = '$id';
	DELETE FROM tag WHERE id_progetto = '$id';
	DELETE FROM progetto WHERE id = '$id';
";

try {
	$result = mysqli_multi_query($conn, $sql);
} catch (Exception $e) {
	echo $e;
}

redirect("account_home.php");
?>
