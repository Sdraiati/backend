<?php
function post($param) {
	$json = file_get_contents("php://input");

	$data = json_decode($json, true);
	if ($data !== null && isset($data[$param])) {
		return $data[$param];
	}
	return $_POST[$param];
}

function get_email() {
	session_start();

	if (!isset($_SESSION['email'])) {
		error("Utente non loggato");
	}

	return sha1($_SESSION['email']);
}

function redirect($param) {
	header("Location: /crosso/{$param}");
	exit();
}

function ok($msg, $param) {
	echo json_encode(["result" => true, "message" => $msg, "data" => $param]);
	http_response_code(200);
	exit();
}

function error($msg) {
	echo json_encode(["result" => false, "message" => $msg]);
	http_response_code(400);
	exit();
}

function is_post() {
	if ($_SERVER["REQUEST_METHOD"] != "POST") {
		error("Richiesta non valida");
	}
}
?>
