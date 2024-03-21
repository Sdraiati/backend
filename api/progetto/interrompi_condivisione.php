<?php
include_once '../config/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["email"])) {
	redirect("resource_not_found.php");
	exit();
}

$email = sha1($_SESSION["email"]);
$json_data = json_decode(file_get_contents("php://input"), true);
$id_progetto = $json_data["id_progetto"];

// check if the user is the owner of the project
$sql = "SELECT * FROM progetto_utente
			WHERE id_progetto = '$id_progetto'
			AND email = '$email'";

try {
$result = mysqli_query($conn, $sql);
} catch (Exception $e) {
	echo $e;
}

if (mysqli_num_rows($result) == 0) {
	redirect("resource_not_found.php");
	exit();
}


$sql = "UPDATE progetto SET link_condivisione = NULL WHERE id = ${id_progetto};";

$result = mysqli_query($conn, $sql);
$conn->close();
exit()
?>
