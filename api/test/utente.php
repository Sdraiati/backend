<?php
include_once './lib.php';
include_once '../utente/service.php';

function testNuovoUtente() {
	$response = make_post('utente/nuovo.php', array(
		'email' => generateRandomString(10) . '@' . generateRandomString(6) . '.com',
		'password' => generateRandomString(10),
		'username' => generateRandomString(10)
	));

	if ($response === false) {
		return failed('Failed to connect to the API');
	}

    $result = json_decode($response, true);

	if (!isset($result['result']) || $result['result'] === false) {
		return failed('No such endpoint');
	}

	return passed();
}

function createRandomUser() {
	$email = generateRandomString(10) . '@' . generateRandomString(6) . '.com';
	$password = generateRandomString(10);
	$username = generateRandomString(10);

	make_post('utente/nuovo.php', array(
		'email' => $email,
		'password' => $password,
		'username' => $username
	));

	return array(
		'email' => $email,
		'password' => $password,
		'username' => $username
	);
}

function testValidaUtente() {
	$user = createRandomUser();

    $response = make_post('utente/valida.php', array(
        'email' => $user['email'],
        'password' => $user['password']
    ));

    if ($response === false) {
        return failed('Failed to connect to the API');
    }

    $result = json_decode($response, true);

    if ($result['result'] === false) {
        return failed($result['message']);
    }

    return passed();
}
?>
