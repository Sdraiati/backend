<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
$email = "leonardo.basso02@gmail.com";
$hash_email = sha1($email);
$id_progetto = "10";

// query al db
// 1. eliminare tutte le spese dell'utente relative al progetto.
// 2. eliminare il legame da progetto_utente (è l'utente che esce dal progetto) 
// 3. contare quanti elementi sono ancora dentro quel progetto (COUNT)
// 4. se 0 => eliminare il record del progetto nella tabella progetto.

$sql_delete_spese = "DELETE FROM movimento WHERE id_progetto = (SELECT id_progetto FROM progetto_utente WHERE id_progetto = ${id_progetto} AND email = \"${hash_email}\"); ";
$sql_delete_legame = "DELETE FROM progetto_utente WHERE email = \"${hash_email}\" AND id_progetto = ${id_progetto}; "; // utente che esce dal progetto 
$sql_count = "SELECT COUNT(id_progetto) FROM progetto_utente WHERE id_progetto = ${id_progetto}; ";

echo '<h1> ' . $sql_delete_spese . ' </h1>';
echo '<h1> ' . $sql_delete_legame . ' </h1>';

if ($sql_count == 0) {
    // eseguire sql_delete_project
    $sql_delete_project = "DELETE FROM progetto WHERE id = ${id_progetto}; ";
}


/*
$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<h2> transazione riuscita </h2>';
} else {
    echo '<h2> transazione NON riuscita </h2>';
}
*/

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}


