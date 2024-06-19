<?php
// define('__GROOT__', dirname(__FILE__, 4));
$proot = dirname(__FILE__, 4);
require_once ($proot.'/models/database/DatabaseManager.php');
class ModifyTag extends DatabaseManager {
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function modifyTag($tagId, $newName, $newDesc) : bool {
        $sql = "UPDATE tag SET nome = ?, descrizione = ? WHERE id = ?";

        $params = [
            ['type' => 's', 'value' => $newName],
            ['type' => 's', 'value' => $newDesc],
            ['type' => 'i', 'value' => $tagId]
        ];

        $stmt = $this->db->prepareAndBindParams($sql, $params);

        $stmt->execute() or die($stmt->error);

        return true;
    }
}