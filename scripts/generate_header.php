<?php

// iniziare una sessione
function generate_header($title)  {
	session_start();
	$content = "";
	if (isset($_SESSION["username"])) {
		$content = file_get_contents("layout/header_already_logged.html");
		$content = str_replace("<title />", "<title>".$title."</title>", $content);
		echo $content;
	} else {
		$content = file_get_contents("layout/header.html");
		$content = str_replace("<title />", "<title>".$title."</title>", $content);
		echo $content;
	}
}
?>
