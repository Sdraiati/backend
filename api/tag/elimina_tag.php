<?php
include_once '../config/database.php';

// prendere i valori dalla POST request 
$id_progetto = "17";
$nome_tag = "cibbbbbbo pazzo"; // 2001-03-10 17:16:18 (the MySQL DATETIME format).

/*
    * PROBLEMA: anche nel caso in cui un record non esiste, la transazione avviene lo stesso
    * di conseguenza ci deve essere un modo di capire dall'oggetto $result se la transazione
    * sia stata o meno un tentativo di eliminare un record inesistente.

    un tag si può eliminare: 
    1. dal progetto => tutte le spese associate a quel tag devono rimuovere la loro associazione 
    => devono essere rimosse solamente le associazioni all'interno di: 
       1. tabella spese
       2. tabella tag (DELETE FROM tag WHERE tag.id_progetto= id_progetto AND tag.nome = nome_tag_da_eliminare).
*/

// query al db
$sql_spesa = "UPDATE movimento SET tag_id = NULL WHERE id_progetto = ${id_progetto}; ";
$sql_tag = "DELETE FROM tag WHERE id_progetto = ${id_progetto} AND nome = \"${nome_tag}\"; "; 
echo '<h1> ' . $sql_spesa . ' </h1>';
echo '<h1> ' . $sql_tag . ' </h1>';

$result = mysqli_query($conn, $sql_spesa);
if ($result) {
    echo '<h2> spese aggiornate </h2>' ;
} 

$result_tag = mysqli_query($conn, $sql_tag);
if ($result_tag) {
    echo '<h2> tag eliminato </h2>' ;
}

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}
