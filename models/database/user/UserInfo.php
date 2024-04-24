<?php
require_once ('User.php');

class UserInfo extends User {
    public function __construct(Database $db) {
        parent::__construct($db);
    }
    public function exists(string $email) : bool {
        $sql = "SELECT * FROM utente WHERE email = '$email'";
        $result = $this->db->query($sql);
        return $result->num_rows > 0;
    }
}
