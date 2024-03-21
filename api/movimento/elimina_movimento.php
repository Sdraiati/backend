<?php
include_once '../config/database.php';

// prendere i valori dalla POST request 
// in questo momento ci sono solo dei valori di prova.
// devono poi essere aggiornati con i valori che
// vengono passati dal cliente tramite pOST request.

/*
    * in questo momento l'elminiazione di un movimento si basa solamente sulla chiave
    * di conseguenza solo su id_progetto e sulla data nella quale è stato inserito quel movimento
    * PROBLEMA: anche nel caso in cui un record non esiste, la transazione avviene lo stesso
    * di conseguenza ci deve essere un modo di capire dall'oggetto $result se la transazione
    * sia stata o meno un tentativo di eliminare un record inesistente.
*/

session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_SESSION['email'])) {
	redirect("resource_not_found.php");
	exit();
}

$data = file_get_contents('php://input');
$id = json_decode($data)->id_transazione;
$id_progetto = json_decode($data)->id_progetto;
$email = sha1($_SESSION['email']);

// check if the user is the owner of the project
$sql = "SELECT * FROM progetto_utente
			WHERE id_progetto = '$id_progetto'
			AND email = '$email'";

try {
	$result = mysqli_query($conn, $sql);
} catch (Exception $e) {
	echo $e;
}

if (mysqli_num_rows($result) == 0) {
	redirect("resource_not_found.php");
	exit();
}

echo json_encode([
	"id" => $id,
	"id_progetto" => $id_progetto
]);

// query al db
$sql = "DELETE FROM movimento WHERE id='${id}';";
$result = mysqli_query($conn, $sql);

if (!$result) {
	http_response_code(500);
	exit();
}

redirect("project_home.php?id=${id_progetto}");

$conn->close();
?>
