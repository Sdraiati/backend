<?php
require_once '../config/database.php';
require_once '../../models/database/user/DeleteUser.php';
require_once '../config/db_config.php';

$error_message = '';

try {
    // Ottieni un'istanza della classe Database
    $database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

    $deleteUser = new DeleteUser($database);

    $email = 'email1@example.com';

    $deleteUser->deleteUser($email);

    echo "Utente eliminato";
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
