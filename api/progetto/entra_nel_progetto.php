<?php
    include '../config/database.php'
?>

<?php

$user_email = "eghosa.basso07@gmail.com"; // l'email dell'utente all'interno del progetto sono salvate all'interno salvate all'interno di 
$hash_email = sha1($user_email);
$hash = $_GET["project"];

echo $hash;
$sql = "SELECT id, link_condivisione FROM progetto WHERE link_condivisione = \"${hash}\"; ";
$result = mysqli_query($conn, $sql);

if ($result) { // quindi il progetto esiste.
    // inserire l'utente all'interno del progetto. 
    // => inserire associazione all'interno della tabella progetto_utente.
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $id_project = $array[0]['id'];

    echo "<p> id progetto: ${id_project} </p>";
    $insert_user = "INSERT INTO progetto_utente (email, id_progetto) VALUES (\"${hash_email}\", ${id_project}); ";
    try {
        $insert_result = mysqli_query($conn, $insert_user);
        if ($insert_result) {
            echo '<h2> pagina del progetto <h2>';
        }
    } catch (mysqli_sql_exception) { // vuol dire che l'utente è giá inserito nel progetto.
        echo '<h2> L\'utente esiste è giá inserito all\'interno del progetto. <h2>';
    }

    
} else {
    echo '<h2> Il link di condivisione è scaduto...  </h2>';
}

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}