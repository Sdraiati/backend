<?php
// create connection
function connect() {
	$DB_HOST = 'localhost';
	$DB_USER = 'root';
	$DB_PASS = '';
	$DB_NAME = 'penny_wise_db';

	$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	if ($conn->connect_error) {
		die("Connection failed");
	}
	return $conn;
}
?>
