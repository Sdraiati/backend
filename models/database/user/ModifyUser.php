<?php
define('__USEOOT__', dirname(__FILE__, 4));
require_once (__USEOOT__.'/models/database/DatabaseManager.php');
require_once(__USEOOT__.'/models/database/user/UserInfo.php');
require_once("models/SetCookie.php");
class ModifyUser extends DatabaseManager {
    private UserInfo $userInfo;
    public function __construct(Database $db) {
        parent::__construct($db);
        $this->userInfo = new UserInfo($db);
    }
    public function modify(string $old_email, array $fields) : bool {
        $id = $this->userInfo->getId($old_email);
        if (!$id) {
            error_log("Failed to get user ID");
            return false;
        }
        if (empty($fileds)) {
            return false;
        }

        $sql = "UPDATE utente SET ";
        $params = [];

        $sql .= implode(' = ?, ', array_keys($fields));
        $sql .= ' = ? WHERE id = ?';

//        $params = array_map(
//            fn($value) => new StmtParam($value),
//            array_values($fields),
//        );

//        $this->db->noResultsPrepared($sql, $params);

        // Costruisci la parte SET della query
//        foreach ($newValues as $key => $value) {
//            $sql .= "$key = ?, ";
//            $params[] = ['type' => 's', 'value' => $value]; // Si presuppone che tutti i valori siano stringhe
//        }
//        $sql = rtrim($sql, ", "); // Rimuove l'ultima virgola e lo spazio

        // Aggiungi la condizione WHERE per l'email
//        $sql .= " WHERE email = ?";
//        $params[] = ['type' => 's', 'value' => $email];

//        $sql = "UPDATE utente SET email = ? WHERE id = ?";
//        // Debug: setta fields
//        $fields = ['nuovamail', '1'];
        foreach ($fields as $key => $value) {
            $params[] = ['type' => 's', 'value' => $value]; // Si presuppone che tutti i valori siano stringhe
        }

        // Prepara e bind i parametri
        $stmt = $this->db->prepareAndBindParams($sql, $params);

        // Verifica se la preparazione è stata eseguita con successo
        if ($stmt === false) {
            error_log("Failed to prepare statement");
            return false;
        }

        // Esegue la query preparata
        if (!$stmt->execute()) {
            error_log("Execution failed: " . $stmt->error);
            return false;
        }

        if ($stmt->affected_rows === 0) {
            error_log("No rows were updated");
            return false;
        }

        // Se non ci sono stati errori, ritorna true
        return true;
    }

}