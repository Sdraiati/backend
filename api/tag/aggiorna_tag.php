<?php
include_once '../config/database.php';

// prendere i valori dalla POST request 
// in questo momento ci sono solo dei valori di prova.
// devono poi essere aggiornati con i valori che
// vengono passati dal cliente tramite pOST request.
/*
    del tag si possono modificare solamente nome e descrizione.
    un tag si può modificare: 
    1. dal progetto => tutte le spese associate a quel tag devono modificare la loro associazione 
    => devono essere modificate in ordine: 
       1. righe della tabella tag (UPDATE tag SET nome_tag = nome_tag_nuovo descrizione = nuova_descrizione WHERE tag_progetto.id_progetto = progetto.id ...).
       2. righe della tabella spese (if NOT NULL => UPDATE movimento SET tag = nuovo_nome_tag WHERE movimento.tag = old_tag;).
*/

$id_progetto = "17";
$nuovo_nome = "cibbbbbbo pazzo";
$nuova_descrizione = "cibbo pazzerello tunze tunze daje daje";

// query al db
$sql = "UPDATE tag SET nome = \"${nuovo_nome}\", descrizione = \"${nuova_descrizione}\" WHERE id_progetto = ${id_progetto}; "; 
echo '<h1> ' . $sql . ' </h1>';

$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<h2> transazione riuscita </h2>' ;
} else {
    echo '<h2> transazione NON riuscita </h2>' ;
}

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}
