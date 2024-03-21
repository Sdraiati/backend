<?php
include_once '../config/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["email"])) {
	redirect("resource_not_found.php");
	exit();
}

$email = sha1($_SESSION["email"]);
$nome = $_POST["nome"];
$descrizione = $_POST["descrizione"];
echo $email;

$sql_progetto = "INSERT INTO progetto (nome, descrizione, link_condivisione) VALUES (?, ?, NULL)";
$stmt = $conn->prepare($sql_progetto);
$stmt->bind_param("ss", $nome, $descrizione);
$stmt->execute();

// Get the ID of the inserted project
$proj_id = $conn->insert_id;;

$sql_utenteprogetto = "INSERT INTO progetto_utente (email, id_progetto) VALUES (?, ?)";
$stmt = $conn->prepare($sql_utenteprogetto);
$stmt->bind_param("si", $email, $proj_id);
$stmt->execute();

redirect("account_home.php");

$conn->close();
?>
