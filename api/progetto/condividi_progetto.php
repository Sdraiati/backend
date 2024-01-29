<?php
    include '../config/database.php'
?>

<?php
    /* 
        logica per creare hash di condivisione gruppo
    */

$id_progetto = "10";
$date_time = date("Y-m-d H:i:s");
$hash_share = sha1($id_progetto . $date_time);

$sql = "UPDATE progetto SET link_condivisione = \"${hash_share}\" WHERE id = ${id_progetto};";
$link = "http://localhost/backend/api/progetto/entra_nel_progetto?project=${hash_share}";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<h2> link creato: ${link} </h2>";
}

if($conn->close()) {
    echo "<h2> connection closed </h2>";
}

// ritornare il link di condivisione oppure la pagina?