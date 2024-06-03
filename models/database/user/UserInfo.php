<?php
define('__USERROOT__', dirname(__FILE__, 4));
require_once (__PROJECTROOT__.'/models/database/DatabaseManager.php');

class UserInfo extends DatabaseManager {
    public function __construct(Database $db) {
        parent::__construct($db);
    }
    public function exists(string $email) : bool {
        $sql = "SELECT * FROM utente WHERE email = '$email'";
        $result = $this->db->query($sql);
        return $result->num_rows > 0;
    }

    public function getId(string $email)  : int {
//        $sql = "SELECT id FROM utente WHERE email = '$email'";
//        $result = $this->db->query($sql);
//        error_log("ffdifjdifj".json_encode($result));
//        if ($result->num_rows == 0) {
//            error_log("No user found with email $email");
//            return false;
//        }
//        return $result;

        $sql = "SELECT id FROM utente WHERE email = ?";
        $params = [
            ['type' => 's', 'value' => $email]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            error_log("No user found with email $email");
            return false;
        }
        return $result->fetch_assoc()['id'];
    }

    public function getUser(string $email, string $password) {
        $sql = "SELECT * FROM utente WHERE email = '$email' AND password = '$password'";
        $result = $this->db->query($sql);
        return $result;
    }
}
