<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
$email = "eghosa.basso07@gmail.com" ;
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
echo '<h1> ' . $sql_count . ' </h1>';

$result = mysqli_query($conn, $sql_delete_spese);
if ($result) {
    echo '<h2> spese rimosse </h2>';
} 

$result_legame = mysqli_query($conn, $sql_delete_legame);
if ($result_legame) {
    echo '<h2> legame rimosso </h2>';
} 

$result_count = mysqli_query($conn, $sql_count);
$array = mysqli_fetch_all($result_count, MYSQLI_ASSOC); // array associativo
$n_users_left = intval($array[0]['COUNT(id_progetto)']);

if ($n_users_left == 0) {
    // eseguire sql_delete_project
    $sql_delete_project = "DELETE FROM progetto WHERE id = ${id_progetto}; ";
    $result_delete = mysqli_query($conn, $sql_delete_project);
    if ($result_delete) {
        echo '<h2> progetto rimosso </h2>';
    }
} else {
    echo '<h2> ci sono ancora utenti legati al progetto. </h2>';
}

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}


