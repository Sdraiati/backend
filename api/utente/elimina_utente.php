<?php
    include '../config/database.php'
?>

<?php

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
*/

$email = "leonardo.basso02@gmail.com";
$username = "bassupreme"; 

// query al db
$sql = "DELETE FROM utente WHERE email= \"${email}\" AND username = \"${username}\"; "; 
$sql = "DELETE FROM utente WHERE email= \"${email}\" AND username = \"${username}\"; "; 
echo '<h1> ' . $sql . ' </h1>';
/*
$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<h2> transazione riuscita </h2>' ;
} 
*/

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}