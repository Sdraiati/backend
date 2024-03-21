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

$date_time = date("Y-m-d H:i:s");
$hash_share = sha1($id_progetto . $date_time);

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


$sql = "UPDATE progetto SET link_condivisione = \"${hash_share}\" WHERE id = ${id_progetto};";

$result = mysqli_query($conn, $sql);

$link = "http://localhost/project_shared?project_id=${hash_share}";

header("Content-Type: application/json");
echo json_encode(["link" => $link]);
$conn->close();
?>
