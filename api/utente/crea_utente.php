<?php
    include '../config/database.php'
?>

<?php

// prendere i valori dalla POST request 
// in questo momento ci sono solo dei valori di prova.
// devono poi essere aggiornati con i valori che
// vengono passati dal cliente tramite pOST request.

$email = "leonardo.basso02@gmail.com";
$username = "bassupreme";
$password = "password non cifrata";
$hash_password = sha1($password);

// query al db
$sql = "INSERT INTO utente (email, username, password) VALUES (\"${email}\", \"${username}\", \"${hash_password}\"); ";
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

