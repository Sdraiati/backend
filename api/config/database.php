<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;
    // Singleton pattern
    private static $instance = null;

    private function __construct($host, $db_name, $username, $password) {
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;
        $this->conn = new mysqli($host, $username, $password, $db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance($host, $db_name, $username, $password) : Database {
        // check if the instance is already created
        if (self::$instance == null) {
            try {
                self::$instance = new Database($host, $db_name, $username, $password);
            } catch (Exception $e) {
                die("get instance error: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    public function query(string $sql) : mysqli_result {
        $result = $this->conn->query($sql);
        return $result;
    }
    public function prepareAndBindParams(string $sql, array $params) : mysqli_stmt | false {
        $stmt = $this->conn->prepare($sql);

        $types = "";
        $values = [];
        foreach ($params as $param) {
            // bind_param requires the type in a string
            $types .= $param['type'];
            $values[] = $param['value'];
        }

        if(strlen($types))
            //... is the spread operator, it allows to pass an array as a list of arguments
            $stmt->bind_param($types, ...$values);

        return $stmt;
    }
}
