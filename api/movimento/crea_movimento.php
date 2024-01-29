<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
// in questo momento ci sono solo dei valori di prova.
// devono poi essere aggiornati con i valori che
// vengono passati dal cliente tramite pOST request.

$id_progetto = "17";
$data = date("Y-m-d H:i:s"); // 2001-03-10 17:16:18 (the MySQL DATETIME format).
$importo = "1.99";
$descrizione = "descrizione relativa a questa spesa";

// query al db
$sql = "INSERT INTO movimento (id_progetto, data, importo, descrizione) VALUES (${id_progetto}, \"${data}\", ${importo}, \"${descrizione}\");";

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

