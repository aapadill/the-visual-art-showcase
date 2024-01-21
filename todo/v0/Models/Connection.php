<?php
namespace Models;

class Connection extends \PDO implements Persistent {

    private static $host = "localhost";
    private static $port = "3306";
    private static $user = "root";
    private static $pass = null;
    private static $dbname = "VisualArtShowcaseDB";

    function  __construct() {
        try {
            parent::__construct("mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname, self::$user, self::$pass);
            $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // die("Connection failed: " . $e->getMessage());
            throw $e;
        }
    }

    public function ownCloseConnection() {
        return true;
    }

    public function ownBeginTransaction() {
        return parent::beginTransaction();
    }

    public function endTransaction($success) {
        if ($success) {
            $this->commit();
        } else {
            $this->rollBack();
        }
        $this->ownCloseConnection();
    }

    public function runQuery($sql, $params = [], $isInsert = false) {
        try {
            $this->ownBeginTransaction();
            $statement = $this->prepare($sql);

            if ($statement === false) {
                throw new \PDOException("Error preparing SQL statement: " . $this->errorInfo()[2]);
            }

            $success = $statement->execute($params);

            if (!$success) {
                throw new \PDOException("Error executing SQL statement: " . $statement->errorInfo()[2]);
            }

            $result = $isInsert ? $this->lastInsertId() : $statement->setFetchMode(\PDO::FETCH_ASSOC);

            // $this->commit();
            // $this->ownCloseConnection();
            // return $result;
            $this->endTransaction(true);
            return $result;
        } catch (\PDOException $e) {
            $this->rollBack();
            // die("Query failed: " . $e->getMessage());
            throw $e;
        }
    }
}
?>
