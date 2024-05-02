<?php
// Includi il file che contiene la definizione della classe UserInfo
require_once '../../models/database/user/UserInfo.php';

// Definisci le credenziali di accesso al database
require_once '../config/db_config.php';

// Variabile per memorizzare il messaggio di errore
$error_message = '';

try {
    // Ottieni un'istanza della classe Database
    $database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

    // Crea un'istanza della classe UserInfo
    $userInfo = new UserInfo($database);

    // Esegui il test per verificare se l'email esiste
    $email = "email2@example.com";
    $exists = $userInfo->exists($email);

    // Visualizza il risultato del test
    if ($exists) {
        echo "L'email $email esiste nel database.";
    } else {
        echo "L'email $email non esiste nel database.";
    }
} catch (Exception $e) {
    // Memorizza il messaggio di errore
    $error_message = $e->getMessage();
}

// Chiudi eventualmente la connessione (questo dipende dallo scenario specifico)
//$database->close();

// Visualizza il messaggio di errore in una pagina HTML
if ($error_message != '') {
    echo "<h1>Errore:</h1>";
    echo "<p>" . $error_message . "</p>";
}
?>
