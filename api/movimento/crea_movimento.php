<?php
include_once '../config/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION['email'])) {
	redirect("resource_not_found.php");
	exit();
}

$email = sha1($_SESSION['email']);
$id = $_POST['id_progetto'];
$data = $_POST['data'];
$importo = $_POST['importo'];
$descrizione = $_POST['descrizione'];
$tag = $_POST['tag'];

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
	redirect("resource_not_found.php");
	exit();
}

$sql = "SELECT * FROM tag
			WHERE nome = '$tag'
			AND id_progetto = '$id'";

$result = mysqli_query($conn, $sql);
$tag_id = 0;

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$tag_id = $row['id'];
} else {
	$sql = "INSERT INTO tag (nome, id_progetto)
			VALUES ('$tag', '$id')";
	$result = mysqli_query($conn, $sql);
	$tag_id = $conn->insert_id;
}

// Prepare the SQL query
$sql = "INSERT INTO movimento (id_progetto, data, importo, descrizione, tag_id)
		VALUES ('$id', '$data', '$importo', '$descrizione', '$tag_id')
";

try {
	$result = mysqli_multi_query($conn, $sql);
} catch (Exception $e) {
	echo $e;
	exit();
}

redirect("project_home.php?id=$id");
?>
