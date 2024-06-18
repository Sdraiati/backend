<?php

$proj_root = dirname(__FILE__, 4);

include_once $proj_root . '/models/database/DatabaseManager.php';

class Movimento extends DatabaseManager
{
	public function __construct(Database $db)
	{
		parent::__construct($db);
	}

	public function new($project_id, $date, $importo, $descrizione, $tag_id): bool
	{
		$sql = "INSERT INTO
					movimento (id_progetto, data, importo, descrizione, tag_id)
				VALUES
					(?, ?, ?, ?, ?)";
		$params = [
			['type' => 'i', 'value' => $project_id],
			['type' => 's', 'value' => $date],
			['type' => 'd', 'value' => $importo],
			['type' => 's', 'value' => $descrizione],
			['type' => 'i', 'value' => $tag_id]
		];

		$stmt = $this->db->prepareAndBindParams($sql, $params);
		$stmt->execute() or die($stmt->error);
		return true;
	}

	public function delete($movimento_id)
	{
		$sql = "DELETE FROM 
					movimento 
				WHERE 
					id = ?";
		$params = [
			['type' => 'i', 'value' => $movimento_id]
		];
		$stmt = $this->db->prepareAndBindParams($sql, $params);
		$stmt->execute() or die($stmt->error);
		return true;
	}

	public function update($movimento_id, array $fields): bool
	{
        //If there is null fields, remove from fields
        foreach ($fields as $key => $value) {
            if ($value === "") {
                unset($fields[$key]);
            }
        }

        if (empty($fields)) {
            return false;
        }

        $sql = "UPDATE movimento SET ";
        $params = [];

        $setStatements = [];
        foreach ($fields as $key => $value) {
            if ($value !== null) {
                $setStatements[] = "$key = ?";
                $params[] = ['type' => 's', 'value' => $value];
            }
        }

        if (empty($setStatements)) {
            return false;
        }

        $sql .= implode(', ', $setStatements);

        $sql .= ' WHERE id = ?';
        $params[] = ['type' => 'i', 'value' => $movimento_id];

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

        return true;
	}

	public function get($project_id)
	{
		$sql =  "SELECT 
					movimento.id, 
					movimento.data, 
					movimento.importo, 
					movimento.descrizione, 
					tag.nome as tag 
				FROM 
					movimento 
				LEFT JOIN 
					tag 
				ON 
					movimento.tag_id = tag.id
				WHERE 
					movimento.id_progetto = ?";

		$params = [
			['type' => 'i', 'value' => $project_id]
		];
		$stmt = $this->db->prepareAndBindParams($sql, $params);
		$stmt->execute() or die($stmt->error);
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
	}
}
