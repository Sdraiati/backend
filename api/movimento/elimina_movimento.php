<?php
    include '../config/database.php'

?>

<?php

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

$id_progetto = "10";
$data = "2024-01-29 18:03:07"; // 2001-03-10 17:16:18 (the MySQL DATETIME format).

// query al db
$sql = "DELETE FROM movimento WHERE id_progetto = ${id_progetto} AND data = \"${data}\"; "; 
echo '<h1> ' . $sql . ' </h1>';

$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<h2> transazione riuscita </h2>' ;
} 

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}