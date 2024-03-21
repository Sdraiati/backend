<?php
include_once '../config/database.php';

// selezionare tutti i progetti associati ad un utente.
$sql = "SELECT progetto.id, progetto.nome, progetto.descrizione FROM (utente, progetto_utente, progetto) WHERE
        utente.email = progetto_utente.email; ";
    
echo '<h1> ' . $sql . ' </h1>';

$result = mysqli_query($conn, $sql);
if ($result) {
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC); // array associativo
    echo json_encode($array);
} 

$conn->close();
