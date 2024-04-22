<?php
// Includi il file che contiene la definizione della classe Database
require_once '../config/database.php';

// Definisci le credenziali di accesso al database
require_once '../config/db_config.php';

// Variabile per memorizzare il messaggio di errore
$error_message = '';

try {
    // Ottieni un'istanza della classe Database
    $database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

    // Esegui una query
    $sql = "SELECT * FROM utente";
    $result = $database->query($sql);

    // Esempio di iterazione sui risultati della query
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "email: " . $row["email"] . " - username: " . $row["username"] . "<br>";
        }
    } else {
        echo "Nessun risultato trovato.";
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