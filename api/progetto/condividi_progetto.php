<?php
    include '../config/database.php'
?>

<?php
    /* 
        logica per creare hash di condivisione gruppo
    */

$id_progetto = "";
$date_time = date("Y-m-d H:i:s");
$link_condivisione = sha1($id_progetto . $date_time);

$sql = "UPDATE progetto SET link_condivisione = \"${link_condivisione}\" WHERE id = ${id_progetto};"
$link = "http://path_to_website/shared_project?=${link_condivisione}";

// ritornare il link di condivisione oppure la pagina?
