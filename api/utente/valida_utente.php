<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	redirect("resource_not_found.php");
	exit();
}

// prendere i valori dalla POST request 
$email = $_POST['email'];
$password = $_POST['password'];

$hash_email = sha1($email);
$hash_password = sha1($password);

// query al db
$sql = "SELECT * FROM utente WHERE 
	email = '$hash_email' and password = '$hash_password';";

$result = mysqli_query($conn, $sql);
$array = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (!$array || count($array) == 0) {
    echo json_encode(["error" => "Email o password errati"]);
	http_response_code(400); // Bad Request
	exit();
} else {
	session_start();
	$_SESSION["email"] = $email;
	$_SESSION["username"] = $array[0]["username"];
	redirect("account_home.php");
	$conn->close();
}
?>
