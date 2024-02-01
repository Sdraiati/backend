<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	header("Location: /404.html");
	exit();
}

// prendere i valori dalla POST request 
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$hash_email = sha1($email);
$hash_password = sha1($password);

// query al db
$sql = "INSERT INTO utente (email, username, password) 
		VALUES ('$hash_email', '$username', '$hash_password');";

try {
    $result = mysqli_query($conn, $sql);
	session_start();
	$_SESSION["email"] = $email;
	$_SESSION["username"] = $username;
	header("Location: account_home.php");

} catch(mysqli_sql_exception) {
	json_encode(["error" => "Email già in uso"]);
	exit();
} 

$conn->close();

?>
