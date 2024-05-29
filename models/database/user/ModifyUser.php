<?php
define('__USEOOT__', dirname(__FILE__, 4));
require_once (__PROJECTROOT__.'/models/database/DatabaseManager.php');
require_once("models/SetCookie.php");
require_once("models/database/project/UserProject.php");
class ModifyUser extends DatabaseManager {
    public function __construct(Database $db) {
        parent::__construct($db);
    }
    public function modify(string $newEmail, string $newUsername, string $newPassword) {
        $oldEmail = json_decode($_COOKIE['LogIn'], true)['email'];
        $oldPassword = $_POST['$oldPassword'];
        $sql = "UPDATE utente SET email = '$newEmail', username = '$newUsername', password = '$newPassword'
        WHERE passowrd = '$oldPassword' and email = '$oldEmail'";
        setCookieUser($newEmail, $newUsername, $newPassword);
        $result = $this->db->query($sql);
        $prg = new UserProject($this->db);
        $prg->modify(json_decode($_COOKIE["LogIn"], true)["email"], $_POST['newEmail']);
        return $result->num_rows > 0;
    }
}