<?php
include_once './service.php';

$old_email = session_start();
is_post();

$email = post('email');
$username = post('username');
$password = post('password');

aggiorna($old_email, $email, $password, $username);
?>
