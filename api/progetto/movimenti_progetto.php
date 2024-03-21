<?php
include_once '../config/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION['email'])) {
    redirect("resource_not_found.php");
    exit();
}

$email = sha1($_SESSION['email']);

$json_data = json_decode(file_get_contents('php://input'), true);
$id_progetto = $json_data['id_progetto'];

// Check if the user is the owner of the project
$sql_check = "SELECT * FROM progetto_utente WHERE id_progetto = '$id_progetto' AND email = '$email';";

$result_check = mysqli_query($conn, $sql_check);

if (!$result_check) {
	http_response_code(500); // Internal Server Error
	echo json_encode(array('error' => 'Database query failed'));
	exit;
}

if (mysqli_num_rows($result_check) == 0) {
	echo json_encode(array('email' => $email, 'id_progetto' => $id_progetto));
	exit;
}

// Prepare the SQL query
$sql = "SELECT movimento.id, movimento.data, movimento.importo, movimento.descrizione, tag.nome as tag 
        FROM movimento JOIN tag ON movimento.tag_id = tag.id
        WHERE movimento.id_progetto = '$id_progetto';";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Check for errors
if (!$result) {
    http_response_code(500); // Internal Server Error
    echo json_encode(array('error' => 'Database query failed'));
    exit;
}

// Fetch the results as an associative array
$array = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the database connection
$conn->close();

// Set the response header to indicate JSON content
header('Content-Type: application/json');

// Encode the array as JSON and output it
echo json_encode($array);
?>
