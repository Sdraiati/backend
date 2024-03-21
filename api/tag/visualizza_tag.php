<?php
include_once "../config/database.php";

$email = get_email();
$project_id = post("project_id");

$sql = "SELECT * FROM progetto_utente WHERE project_id = '$project_id' AND email = '$email'";

try {
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
	redirect("resource_not_found.php");
	exit();
}
} catch (Exception $e) {
	redirect("resource_not_found.php");
	exit;
}

$sql = "SELECT nome as name, descrizione FROM tag WHERE project_id = '$project_id'";

try {
	$result = mysqli_query($conn, $sql);
} catch (Exception $e) {
	redirect("resource_not_found.php");
	exit();
}

$tags = $result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode($tags);
?>
