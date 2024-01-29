<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
$email = "leonardo.basso02@gmail.com";
$username = "bassupreme";
$password = "password non cifrata";

$hash_email = sha1($email);
$hash_username = sha1($username);
$hash_password = sha1($password);

// query al db
$sql = "SELECT * FROM utente WHERE email = \"${hash_email}\"; ";
echo '<h1> ' . $sql . ' </h1>';
$result = mysqli_query($conn, $sql);

if ($result) { 
    // email corrispondente trovata => utente registrato nel db.
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if ($hash_password == sha1($array['password'])) {
        // autenticazione riuscita
    } else {
        // autenticazione fallita
    }

} else {
    echo '<h2> generare pagina di errore. </h2>';
}

if($conn->close()) {
    echo '<h2> connection closed </h2>';
}


