
<?php
    include '../config/database.php'

?>

<?php

// prendere i valori dalla POST request 
// in questo momento ci sono solo dei valori di prova.
// devono poi essere aggiornati con i valori che
// vengono passati dal cliente tramite pOST request.
$nome = "tag di prova";
$id_progetto = "1";
$descrizione = "descrizione relativa a questo tag";

// query al db
$sql = "INSERT INTO tag (nome, id_progetto, descrizione) VALUES (\"${nome}\", ${id_progetto}, \"${descrizione}\"); ";
echo '<h1> ' . $sql . ' </h1>';



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

