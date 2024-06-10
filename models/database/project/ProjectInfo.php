<?php
define('__PROJECTINFOROOT__', dirname(__FILE__, 4));
require_once(__PROJECTINFOROOT__ . '/models/database/DatabaseManager.php');
class ProjectInfo extends DatabaseManager
{
	public function __construct(Database $db)
	{
		parent::__construct($db);
	}

	public function exists(int $projectId): bool
	{
		$sql = "SELECT * FROM progetto WHERE id = ?";
		$params = [
			['type' => 'i', 'value' => $projectId]
		];
		$stmt = $this->db->prepareAndBindParams($sql, $params);
		$stmt->execute() or die($stmt->error);
		return $stmt->get_result()->num_rows > 0;
	}

	public function getProjectInfo($projectId): array
	{
		$sql = "SELECT * FROM progetto WHERE id = ?";
		$params = [
			['type' => 'i', 'value' => $projectId]
		];
		$stmt = $this->db->prepareAndBindParams($sql, $params);
		$stmt->execute() or die($stmt->error);
		return $stmt->get_result()->fetch_assoc();
	}

	public function getProjectInfoByLink($link): array{
		$sql = "SELECT * FROM progetto WHERE link_condivisione = ?";
		$params = [
			['type' => 's', 'value' => $link]
		];
		$stmt = $this->db->prepareAndBindParams($sql, $params);
		$stmt->execute() or die($stmt->error);
		return $stmt->get_result()->fetch_assoc();
	}

    public function getIDProjectByLink($link): int {
        $sql = "SELECT ID FROM progetto WHERE link_condivisione = ?";
        $params = [
            ['type' => 's', 'value' => $link]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        $result = $stmt->get_result()->fetch_assoc();

        if ($result !== null && array_key_exists('ID', $result)) {
            return (int) $result['ID'];
        } else {
            throw new Exception("Project ID not found for the provided link.");
        }
    }
	
	public function getProjectList($email): array
	{
		$sql = "SELECT 
                    utente.email AS email, 
                    progetto.* 
                FROM 
                    utente
                JOIN 
                    progetto_utente ON utente.id = progetto_utente.id_utente
                JOIN 
                    progetto ON progetto_utente.id_progetto = progetto.id
                WHERE 
                    utente.email = ?";
		$params = [
			['type' => 's', 'value' => $email]
		];
		$stmt = $this->db->prepareAndBindParams($sql,  $params);
		$stmt->execute() or die($stmt->error);
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
	}
}

