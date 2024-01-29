<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
$id_progetto = "1";
$nome_tag = "nome_tag"; // 2001-03-10 17:16:18 (the MySQL DATETIME format).

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
$sql_spesa = "UPDATE movimento SET tag = NULL WHERE id_progetto = ${id_progetto}; ";
$sql_tag = "DELETE FROM tag WHERE id_progetto = ${id_progetto} AND tag = \"${nome_tag}\"; "; 
echo '<h1> ' . $sql_spesa . ' </h1>';
echo '<h1> ' . $sql_tag . ' </h1>';

/*
$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<h2> transazione riuscita </h2>' ;
} 
*/

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}