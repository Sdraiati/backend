<?php
require_once '../config/database.php';
require_once '../../models/database/project/NewProject.php';
require_once '../config/db_config.php';

$error_message = '';

try {
    // Ottieni un'istanza della classe Database
    $database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

    // Crea un'istanza della classe NewProject
    $newProject = new NewProject($database);

    $nome = 'risparmio1';
    $descrizione = 'provaprova';
    $email = 'simone@mail.com';
    $link_condivisione = 'ciaooo.com';

    // Creazione del progetto
    $newProject->createProject($email, $nome, $link_condivisione, $descrizione);

    echo "Il progetto è stato creato con successo";
} catch (Exception $e) {
    // Memorizza il messaggio di errore
    $error_message = $e->getMessage();
}

// Visualizza il messaggio di errore in una pagina HTML
if ($error_message != '') {
    echo "<h1>Errore:</h1>";
    echo "<p>" . $error_message . "</p>";
}