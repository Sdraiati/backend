<?php
    include '../config/database.php';
?>
<?php
    include '../../scripts/dyn_front_end_builder.php'; // script per generare la pagina html
?>

<?php

// prendere i valori dalla POST request 
$email = $_POST['email'];
$password = $_POST['password'];

$hash_email = sha1($email);
$hash_password = sha1($password);

// query al db
$sql = "SELECT * FROM utente WHERE email = \"${hash_email}\"; ";
// echo '<h1> ' . $sql . ' </h1>';
$result = mysqli_query($conn, $sql);

if ($result) { 
    // email corrispondente trovata => utente registrato nel db.
    $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (count($array) > 0) {
        if ($hash_password == $array[0]["password"]) {
            // autenticazione riuscita => pagina di benvenuto?
            // creare la sessione 

            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $array[0]["username"];
            header("Location: /backend/content/account_home.php");
        } else {
            // autenticazione fallita => pagina di errore.
            echo '<h2> Password sbagliata. </h2>';
        }
    } else {
        echo '<h2> utente non trovato </h2>';
    }
} else {
    echo '<h2> generare pagina di errore. </h2>';
}

$conn->close();
