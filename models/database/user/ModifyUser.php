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
    public function modify(string $old_email, string $old_password, array $fields) : bool {
        $user = $this->userInfo->getUser($old_email);
        if (count($user) == 0) {
            error_log("No user found with email $old_email and password $old_password");
            return false;
        }
        $id = $this->userInfo->getId($old_email);
        if (!$id) {
            error_log("Failed to get user ID");
            return false;
        }
        if (empty($fields)) {
            //error_log("fields ". json_encode($fields));
            error_log("No fields to update");
            return false;
        }

        $sql = "UPDATE utente SET ";
        $params = [];

        $setStatements = [];
        foreach ($fields as $key => $value) {
            if ($value !== null) {
                $setStatements[] = "$key = ?";
                $params[] = ['type' => 's', 'value' => $value];
            }
        }

        if (empty($setStatements)) {
            error_log("No non-null fields to update");
            return false;
        }

        // Unisci le dichiarazioni SET in una stringa
        $sql .= implode(', ', $setStatements);

        $sql .= ' WHERE id = ?';
        $params[] = ['type' => 'i', 'value' => $id];

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