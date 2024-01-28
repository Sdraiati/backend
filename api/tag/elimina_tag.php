<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
// in questo momento ci sono solo dei valori di prova.
// devono poi essere aggiornati con i valori che
// vengono passati dal cliente tramite pOST request.

/*
    * PROBLEMA: anche nel caso in cui un record non esiste, la transazione avviene lo stesso
    * di conseguenza ci deve essere un modo di capire dall'oggetto $result se la transazione
    * sia stata o meno un tentativo di eliminare un record inesistente.

    un tag si può eliminare: 
    1. globalmente => tutti i progetti contenenti quel tag allora devono rimuoverlo e se 
    ci sono spese correlate a quel tag, rimuovere l'associazione al tag 
    2. dal progetto => tutte le spese associate a quel tag devono rimuovere la loro associazione 
    ad esso e il progetto deve rimuovere l'associazione a quel tag. 
*/

$id_progetto = "1";
$data = "2024-01-27 11:48:30"; // 2001-03-10 17:16:18 (the MySQL DATETIME format).

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