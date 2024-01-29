<?php
    include '../config/database.php'

?>

<?php

// prendere i valori dalla POST request 
$nome = "progetto di prova";
$descrizione = "questo è un progetto di prova";

// query al db
// 1. eliminare il legame da progetto_utente (è l'utente che esce dal progetto) 
// 2. contare quanti elementi sono ancora dentro quel progetto (COUNT)
// 3. se 0 => eliminare il record del progetto nella tabella progetto.

echo '<h1> ' . $sql . ' </h1>';

$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<h2> transazione riuscita </h2>';
} else {
    echo '<h2> transazione NON riuscita </h2>';
}

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}


