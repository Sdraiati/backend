<?php
include_once './service.php';

is_post();

$email = post('email');
$password = post('password');
$username = post('username');

nuovo($email, $password, $username);
?>
