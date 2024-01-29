<?php
    include '../config/database.php'
?>

<?php

// selezionare tutti i progetti associati ad un utente.
$sql = "SELECT progetto.id, progetto.nome, progetto.descrizione FROM (utente, progetto_utente, progetto) WHERE
        utente.email = progetto_utente.email; ";
    
echo '<h1> ' . $sql . ' </h1>';

/*
$result = mysqli_query($conn, $sql);
if ($result) {
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC); // array associativo
    if (count($array) > 0) {
        var_dump($array);
    } else {
        echo '<h2> non sono stati trovati movimenti associati al progetto </h2>';
    }
} 
*/

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}