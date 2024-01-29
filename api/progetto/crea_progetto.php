<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
$email_user = "leonardo.basso02@gmail.com"; // questo per il momento si tiene in una post request...poi è un dato appartenente alla sessione.
$hash_email = sha1($email_user);
$nome = "projectY";
$descrizione = "questo è un progetto del piripillo";

// 1. creare record progetto
$sql_progetto = "INSERT INTO progetto (nome, descrizione, link_condivisione) VALUES (\"${nome}\", \"${descrizione}\", NULL);";



if (mysqli_query($conn, $sql_progetto)) {
    $last_id = $conn->insert_id;
    echo '<h2> progetto creato correttamente </h2>';

    // 2. inserire legame utente con progett all'interno di progetto_utente.
    var_dump($last_id);
    $sql_legame_utenteprogetto = "INSERT INTO progetto_utente (email, id_progetto) VALUES (\"${hash_email}\", ${last_id});";
    echo $sql_legame_utenteprogetto;
    $result_legame = mysqli_query($conn, $sql_legame_utenteprogetto);
    if ($result_legame) {
        echo '<h2> legame creato </h2>';
    }

} else {
    echo '<h2> progetto non creato </h2>';
}

/* 
    PROBLREMA: ipotizziamo che
    1. la connessione dovesse interrompersi tra la query
    precedente e la successiva
    2. un altro utente crea un nuovo progetto con successo <=>
    precedente e successiva vengono eseguite correttamente.
    => l'ultimo id è cambiatmo
    => l'utente che ha perso la connessione durante la creazione ha un id del progetto sbagliato.
*/


if($conn->close()) {
    echo '<h2> connection closed </h2>';
}

