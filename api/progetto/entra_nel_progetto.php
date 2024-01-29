<?php
    include '../config/database.php'
?>

<?php

$link = $_GET["link_condivisione"];

$sql = "SELECT id FROM progetto WHERE link_condivisione = \"${link}\"; ";

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