<?php
define('__USERROOT__', dirname(__FILE__, 4));
require_once(__USERROOT__.'/api/config/database.php');

class UserInfo
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function exists(string $email) : bool {
        $sql = "SELECT * FROM utente WHERE email = '$email'";
        $result = $this->db->query($sql);
        return $result->num_rows > 0;
    }
}
