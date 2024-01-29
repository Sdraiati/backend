<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
$nome = "progetto di prova";
$descrizione = "questo è un progetto di prova";

// query al db
// 1. creare record progetto
$sql = "INSERT INTO progetto (nome, descrizione) VALUES (\"${nome}\", \"${descrizione}\");";
// 2. inserire legame utente con progett all'interno di progetto_utente.
$sql = "INSERT INTO progetto_utente (email, id_progetto) VALUES (\"${nome}\", \"${descrizione}\");";

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

