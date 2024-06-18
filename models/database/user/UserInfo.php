<?php
define('__USERROOT__', dirname(__FILE__, 4));
require_once(__PROJECTROOT__ . '/models/database/DatabaseManager.php');

class UserInfo extends DatabaseManager
{
	public function __construct(Database $db)
	{
		parent::__construct($db);
	}
    public function exists(int $id): bool
    {
        $sql = "SELECT * FROM utente WHERE id = ?";
        $params = [
            ['type' => 'i', 'value' => $id]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        return $stmt->get_result()->num_rows > 0;
    }

	public function existsByEmail(string $email): bool
	{
		$sql = "SELECT * FROM utente WHERE email = '$email'";
		$result = $this->db->query($sql);
		return $result->num_rows > 0;
	}

	public function getId(string $email): int
	{
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

	public function checkCredentials(string $email, string $password): bool
	{
		$sql = "SELECT * FROM utente WHERE email = ? AND password = ?";
		$params = [
			['type' => 's', 'value' => $email],
			['type' => 's', 'value' => $password]
		];
		$stmt = $this->db->prepareAndBindParams($sql, $params);

        if (!$stmt) {
            error_log("Failed to prepare statement");
            return false;
        }

        $result = $stmt->execute();

        if (!$result) {
            error_log("Failed to execute statement");
            return false;
        }

		$result = $stmt->get_result();

		return $result->num_rows > 0;
	}

	public function getUser(string $email)
	{
		$sql = "SELECT * FROM utente WHERE email = ?";
		$params = [
			['type' => 's', 'value' => $email]
		];
		$stmt = $this->db->prepareAndBindParams($sql, $params);
		$stmt->execute() or die($stmt->error);
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			return false;
		}
		return $result->fetch_assoc();
	}

    public function getPartecipantsList(int $project_id)
    {
        $sql = "SELECT username FROM utente JOIN progetto_utente ON utente.id = progetto_utente.id_utente WHERE progetto_utente.id_progetto = ?";
        $params = [
            ['type' => 'i', 'value' => $project_id]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        $result = $stmt->get_result();
        $partecipants = [];
        while ($row = $result->fetch_assoc()) {
            $partecipants[] = $row['username'];
        }
        return $partecipants;
    }
}
