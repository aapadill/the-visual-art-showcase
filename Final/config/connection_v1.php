<?php
class DatabaseConnection {
    private $host = 'localhost'; //move these to environment variables
    private $user = 'root';
    private $password = null;
    private $database = 'VisualArtShowcaseDB';
    private $connection;

    public function __construct() {
        $this->openConnection();
    }

    private function openConnection() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->connection->connect_error) {
            //handle error - log it and/or send notification
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function executeQuery($sql) {
        //use prepared statements for security
        $stmt = $this->connection->prepare($sql);
        //bind parameters and execute
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function cleanData($value) {
        return $value;
    }

    public function __destruct() {
        $this->connection->close();
    }
}

//usage
//$db = new DatabaseConnection();
//$results = $db->executeQuery("SELECT * FROM table_name");
?>
