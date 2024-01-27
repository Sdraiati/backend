<?php
    include '../config/database.php'

?>

<?php


// prendere i valori dalla POST request 
$nome = 'nome';
$descrizione = 'descrizione';

// query al db
$sql = "INSERT INTO project (nome, descrizione) VALUES ('". $nome . "', '". $descrizione . "');";

echo '<h1> ' . $sql . ' </h1>';

/*
$result = mysqli_query($conn, $sql);
if ($result) {
    return true
} 
return false;
*/