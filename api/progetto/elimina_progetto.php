<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
$email = "email.prova@gmail.com";
$id_progetto = "1";

// query al db
// 1. eliminare il legame da progetto_utente (è l'utente che esce dal progetto) 
// 2. contare quanti elementi sono ancora dentro quel progetto (COUNT)
// 3. se 0 => eliminare il record del progetto nella tabella progetto.

$sql_legame = "DELETE FROM progetto_utente WHERE email = \"${email}\" AND id_progetto = ${id_progetto}; "; // utente che esce dal progetto 
$sql_count = "SELECT COUNT(id_progetto) FROM progetto_utente WHERE id_progetto = ${id_progetto}; ";
$sql_delete_project = "DELETE FROM progetto WHERE id = ${id_progetto}; ";

echo '<h1> ' . $sql_legame . ' </h1>';
echo '<h1> ' . $sql_count . ' </h1>';

if ($sql_count == 0) {
    // eseguire sql_delete_project
}

echo '<h1> ' . $sql_delete_project . ' </h1>';

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


