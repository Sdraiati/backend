<?php
require_once '../config/database.php';
require_once '../../models/database/project/JoinProject.php';
require_once '../config/db_config.php';

$error_message = '';

try {
    // Ottieni un'istanza della classe Database
    $database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

    $joinProject = new JoinProject($database);

    $email = 'email3@example.com';
    $projectID = 1;

    $joinProject->joinProject($email, $projectID);

    echo "Utente aggiunto al progetto con successo";
} catch (Exception $e) {
    // Memorizza il messaggio di errore
    $error_message = $e->getMessage();
}

// Visualizza il messaggio di errore in una pagina HTML
if ($error_message != '') {
    echo "<h1>Errore:</h1>";
    echo "<p>" . $error_message . "</p>";
}