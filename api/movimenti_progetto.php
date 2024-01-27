<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
$id_progetto = '1';

// query al db
$sql = "SELECT * FROM (progetto, movimento) WHERE progetto.id = movimento.id_progetto AND id = " . $id_progetto . "; ";
echo '<h1> ' . $sql . ' </h1>';



$result = mysqli_query($conn, $sql);
if ($result) {
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC); // array associativo
    if (count($array) > 0) {
        var_dump($array);
    } else {
        echo '<h2> non sono stati trovati movimenti associati al progetto </h2>';
    }
} 

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}