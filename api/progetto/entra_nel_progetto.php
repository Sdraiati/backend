<?php
include_once '../config/database.php';

session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION["email"])) {
	redirect("resource_not_found.php");
	exit();
}

$email = sha1($_SESSION["email"]);
echo file_get_contents("php://input");

$hash = $_POST["id_progetto"];

$sql = "SELECT id FROM progetto WHERE link_condivisione = \"$hash\"; ";
$result = mysqli_query($conn, $sql);

if (!$result) {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$id_progetto = mysqli_fetch_assoc($result)['id'];

$insert_user = "INSERT INTO progetto_utente (email, id_progetto) VALUES (\"$email\", $id_progetto); ";

try {
	$insert_result = mysqli_query($conn, $insert_user);
} catch (Exception $e) {
}

redirect("project_home.php?id=${id_progetto}");

    
$conn->close()
?>
