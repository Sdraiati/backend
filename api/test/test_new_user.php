<<?php
require_once '../config/database.php';
require_once '../../models/database/user/NewUser.php';
require_once '../config/db_config.php';

$error_message = '';

try {
    // Ottieni un'istanza della classe Database
    $database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

    $newUser = new NewUser($database);

    $email = 'pinco@pallino.com';
    $username = 'pallino';
    $password = 'pallino123';

    // Creazione dell'utente
    $newUser->createUser($email, $username, $password);

    echo "Utente creato con successo";
} catch (Exception $e) {
    // Memorizza il messaggio di errore
    $error_message = $e->getMessage();
}

// Visualizza il messaggio di errore in una pagina HTML
if ($error_message != '') {
    echo "<h1>Errore:</h1>";
    echo "<p>" . $error_message . "</p>";
}
?>
