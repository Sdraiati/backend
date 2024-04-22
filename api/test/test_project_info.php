<?php
require_once '../config/database.php';
require_once '../../models/database/project/ProjectInfo.php';
require_once '../config/db_config.php';

$error_message = '';

try {
    // Ottieni un'istanza della classe Database
    $database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

    // Crea un'istanza della classe ProjectInfo
    $projectInfo = new ProjectInfo($database);

    $email = 'simone@mail.com';
    $id_progetto = 6;

    echo "esito: " . $projectInfo->isProjectOwner($id_progetto, $email);
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