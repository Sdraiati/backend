<?php
include_once './service.php';

is_post();

// prendere i valori dalla POST request 
$email = post('email');
$password = post('password');

// chiamare la funzione valida
valida($email, $password);
?>
