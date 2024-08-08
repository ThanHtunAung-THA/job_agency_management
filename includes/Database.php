<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'overseas_job_central');

class Database {
    private $conn;

    // Constructor
    public function __construct() {
        $this->connect();
    }

    // Establish database connection
    private function connect() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Get connection
    public function getConnection() {
        return $this->conn;
    }

    // Close connection
    public function close() {
        $this->conn->close();
    }
}
?>
