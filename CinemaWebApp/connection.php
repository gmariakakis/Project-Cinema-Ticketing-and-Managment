<?php

class conct {
    public $username = "root";
    public $password = "";
    public $server_name = "localhost";
    public $db_name = "cinema_db";
    public $conn;

    function __construct() {
        $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function select_all($table_name) {
        $sql = "SELECT * FROM $table_name";
        $result = $this->conn->query($sql);
        return $result;
    }

    function select($table_name, $id) {
        $sql = "SELECT * FROM $table_name WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function insert($table_name, $data)//The insert method takes two parameters: the name of the table and an associative array where keys are column names and values are the data to be inserted.
   // It constructs an SQL INSERT statement dynamically based on the provided data.
   // It uses prepared statements for security (to prevent SQL injection).
    //The method returns the last inserted ID for success or an error message for failure.
     {
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table_name ($columns) VALUES ($values)";
        
        $stmt = $this->conn->prepare($sql);

        $types = str_repeat('s', count($data)); // Assuming all inputs are strings
        $values = array_values($data);
        $stmt->bind_param($types, ...$values);
        
        if(!$stmt->execute()) {
            return "Error: " . $stmt->error;
        }

        $stmt->close();
        return $this->conn->insert_id;
    }
}

?>
