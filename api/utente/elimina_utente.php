<?php
include_once '../config/database.php';

// prendere i valori dalla POST request 
// in questo momento ci sono solo dei valori di prova.
// devono poi essere aggiornati con i valori che
// vengono passati dal cliente tramite pOST request.

/*
    * l'elminiazione di un utene si basa sull'email
    * PROBLEMA: anche nel caso in cui un utente non esiste, la transazione avviene lo stesso
    * di conseguenza ci deve essere un modo di capire dall'oggetto $result se la transazione
    * sia stata o meno un tentativo di eliminare un record inesistente.

    altro problema...se un utente è associato ad un progetto bisogna eliminare: 
    1. tutte le spese dell'utente
    2. tutte le associazioni dell'utente con tutti i progetti nei quali è coinvolto.
    3. il record dell'utente all'interno della tabella dell'utente.
*/

$email = "leonardo.basso02@gmail.com";
$username = "bassupreme"; 

$hash_email = sha1($email);
$hash_username = sha1($username);

// query al db 
$sql_spese = "DELETE FROM (utente, progetto_utente, movimento) WHERE 
    utente.email = progetto_utente.email AND progetto_utente.id_progetto = movimento.id_progetto AND
    email= \"${hash_email}\" ";

$sql_spese_2 = "DELETE FROM movimento WHERE 
    movimento.id_progetto = (SELECT movimento.id_progetto FROM (utente, progetto_utente, movimento) utente.email = progetto_utente.email AND progetto_utente.id_progetto = movimento.id_progetto AND
    email= \"${hash_email}\"); ";

$sql_progetto = "DELETE FROM (utente, progetto) WHERE 
    utente.email = progetto_utente.email  AND
    email= \"${hash_email}\" ";

$sql_utente = "DELETE FROM (utente) WHERE email= \"${hash_email}\" "; 

// TEST
echo '<h1> ' . $sql_spese_2 . ' </h1>';
echo '<h1> ' . $sql_progetto . ' </h1>';
echo '<h1> ' . $sql_utente . ' </h1>';

/*
$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<h2> transazione riuscita </h2>' ;
} 
*/

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}
