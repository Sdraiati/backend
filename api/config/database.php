<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'crosso');
    define('DB_PASS', 'eaqu8agaega0iBie');
    define('DB_NAME', 'crosso');

    // create 
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die('Connection failed ' . $conn->connect_error);
    }

function post($param) {
	$json = file_get_contents("php://input");
	if ($json != "") {
		$data = json_decode($json, true);
		return $data[$param];
	}
	return $_POST[$param];
}

function get_email() {
	session_start();

	if (!isset($_SESSION['email'])) {
		redirect("resouce_not_found.html");
		exit();
	}

	return sha1($_SESSION['email']);
}

function redirect($param) {
	header("Location: /crosso/${param}");
	exit();
}
?>

