<?php

include '../config/database.php';
if ($_SERVER["REQUEST_METHOD"] != "POST") {
	redirect("resource_not_found.php");
	exit();
}

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$hash_email = sha1($email);
$hash_password = sha1($password);

$sql = "INSERT INTO utente (email, username, password) 
		VALUES ('$hash_email', '$username', '$hash_password');";

try {
    $result = mysqli_query($conn, $sql);
	session_start();
	$_SESSION["email"] = $email;
	$_SESSION["username"] = $username;
	redirect("account_home.php");

} catch(mysqli_sql_exception $e) {
	echo $e->getMessage();
	exit();
} 
?>
