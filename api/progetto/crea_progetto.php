<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
$email_user = "email.prova@gmail.com";
$nome = "progetto di prova";
$descrizione = "questo è un progetto di prova";
$link_condivisione = "";

// query al db

// 1. creare record progetto
$sql_progetto = "INSERT INTO progetto (nome, descrizione, link_condivisione) VALUES (\"${nome}\", \"${descrizione}\", \"${link_condivisione}\");";
// 2. inserire legame utente con progett all'interno di progetto_utente.
/* 
    PROBLREMA: ipotizziamo che
    1. la connessione dovesse interrompersi tra la query
    precedente e la successiva
    2. un altro utente crea un nuovo progetto con successo <=>
    precedente e successiva vengono eseguite correttamente.
    => l'ultimo id è cambiatmo
    => l'utente che ha perso la connessione durante la creazione ha un id del progetto sbagliato.
*/
// $last_id = mysql_insert_id();
$last_id = "1";
$sql_legame_utenteprogetto = "INSERT INTO progetto_utente (email, id_progetto) VALUES (\"${email_user}\", ${last_id});";

echo '<h1> ' . $sql_progetto . ' </h1>';
echo '<h1> ' . $sql_legame_utenteprogetto . ' </h1>';

/*
$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<h2> pagina che visualizza progetto appena creato </h2>';
} else {
    echo '<h2> pagina di errore </h2>';
}
*/

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}

