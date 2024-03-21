<?php
include_once '../config/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION['email'])) {
	redirect("resource_not_found.php");
	exit();
}

$email = sha1($_SESSION['email']);
$id_progetto = $_POST['id_progetto'];
$nuovo_importo = $_POST['importo'];
$nuova_descrizione = $_POST['descrizione'];
$tag = $_POST['tag'];
$nuova_data = $_POST['data'];
$id_movimento = $_POST['id_transazione'];

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

$sql = "SELECT * FROM tag
			WHERE nome = '$tag'
			AND id_progetto = '$id_progetto'";

$result = mysqli_query($conn, $sql);
$tag_id = 0;

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$tag_id = $row['id'];
} else {
	$sql = "INSERT INTO tag (nome, id_progetto)
			VALUES ('$tag', '$id_progetto')";
	$result = mysqli_query($conn, $sql);
	$tag_id = $conn->insert_id;
}

// query al db
$sql = "UPDATE movimento 
		SET importo = ?, descrizione = ?, data = ?, tag_id = ?
		WHERE id = ${id_movimento}"; 

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "dssi", $nuovo_importo, $nuova_descrizione, $nuova_data, $tag_id);

try {
	$stmt->execute();
} catch (Exception $e) {
	echo $e;
	exit();
}

redirect("project_home.php?id=${id_progetto}");
?>
