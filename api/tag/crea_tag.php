<?php
include_once '../config/database.php';

$email = get_email();

// prendere i valori dalla POST request 
// in questo momento ci sono solo dei valori di prova.
// devono poi essere aggiornati con i valori che
// vengono passati dal cliente tramite pOST request.

$nome = post('nome');
$id_progetto = post('id_progetto');
$descrizione = post('descrizione');

echo json_encode("$nome, $id_progetto, $descrizione");

// query al db
$sql = "INSERT INTO tag (nome, id_progetto, descrizione) VALUES (\"${nome}\", ${id_progetto}, \"${descrizione}\"); ";

try {
$result = mysqli_query($conn, $sql);
} catch (Exception $e) {
	echo $e;
}

redirect('tag_page.php?id=' . $id_progetto);
?>
