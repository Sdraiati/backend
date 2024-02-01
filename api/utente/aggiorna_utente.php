<?php
include '../config/database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION['email'])) {
	redirect("resource_not_found.php");
}

$old_email = sha1($_SESSION['email']);
$old_password = sha1($_POST['old_password']);

// check if the old password is correct
$sql = "SELECT * FROM utente WHERE email = '${old_email}' AND password = '${old_password}';";

$result = mysqli_query($conn, $sql);

if (!$result) {
	http_response_code(500);
	exit();
}

if (mysqli_num_rows($result) == 0) {
	http_response_code(401);
	exit();
}

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$hash_email = sha1($email);
$hash_password = sha1($password);

// query al db
$sql = "UPDATE utente SET email = '${hash_email}', username = '${username}', password = '${hash_password}' WHERE email = '${old_email}';";

try {
	$result = mysqli_query($conn, $sql);
	$_SESSION["email"] = $email;
	$_SESSION["username"] = $username;
	redirect("account_home.php");

} catch(mysqli_sql_exception) {
	json_encode(["error" => "Email già in uso"]);
	exit();
}
?>
