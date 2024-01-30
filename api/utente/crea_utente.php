<?php
    include '../config/database.php';
    include '../scripts/dyn_front_end_builder.php';
?>

<?php

// prendere i valori dalla POST request 
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$hash_email = sha1($email);
$hash_username = sha1($username);
$hash_password = sha1($password);

// query al db
$sql = "INSERT INTO utente (email, username, password) VALUES (\"${hash_email}\", \"${hash_username}\", \"${hash_password}\"); ";
echo '<h1> ' . $sql . ' </h1>';
try {
    $result = mysqli_query($conn, $sql);

    echo '<h2> pagina di login </h2>';
} catch(mysqli_sql_exception) {
    echo '<h2> error utente già esistente </h2>';
}


if($conn->close()) {
    echo '<h2> connection closed </h2>';
}

