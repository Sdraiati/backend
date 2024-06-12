<?php
define('__PROOT__', dirname(__FILE__, 4));
require_once(__PROOT__ . '/models/database/DatabaseManager.php');
class ModifyProject extends DatabaseManager {
    public function __construct(Database $db) {
        parent::__construct($db);
    }
    public function modify(int $id, array $fields) : bool {
        // If there is null fields, remove from fields
        foreach ($fields as $key => $value) {
            if ($value === "") {
                unset($fields[$key]);
            }
        }

        if (empty($fields)) {
            error_log("No fields to update");
            return false;
        }

        $sql = "UPDATE progetto SET ";
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
        if (!$stmt) {
            error_log("Failed to prepare statement");
            return false;
        }

        // Esegui la query
        $result = $stmt->execute();

        // Verifica se la query è stata eseguita con successo
        if (!$result) {
            error_log("Failed to execute statement");
            return false;
        }

        return true;
    }
}