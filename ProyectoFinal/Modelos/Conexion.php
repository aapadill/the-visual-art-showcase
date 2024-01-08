<?php
namespace Modelos;

class Conexion extends \PDO implements Persistente {

    public static $host = "localhost";
    public static $port = "3306";
    public static $user = "root";
    public static $pass = null;
    public static $dbname = "tienda";

    function  __construct() {
        try {
            parent::__construct("mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname, self::$user, self::$pass);
        } catch (\PDOException $e) {
            die("No se pudo conectar: " . $e->getMessage());
        }
    }

    public function cerrarConexion() {
       return true;
    }

    public function empezarTransaccion(){
        return $this->beginTransaction();
    }

    public function terminarTransaccion($success){
        if ($success) {
            $this->commit();
        } else {
            $this->rollBack();
        }
        $this->cerrarConexion();
    }

    public function correrQuery($sql, $params = [], $esInsert = false) {
        $correcto = $this->empezarTransaccion();
        if (empty($correcto)) {
            return false;
        }
        $resultados = parent::prepare($sql); // $this->prepare()
        if (empty($resultados)) {
            $this->terminarTransaccion(false);
            return false;
        }
        $correcto = $resultados->execute($params); // PDOStatemaet
        $resultados->setFetchMode(\PDO::FETCH_ASSOC);
        if (!empty($esInsert) && $correcto) {
            $resultados = parent::lastInsertId(); // $this->lasInsertedId()
        }
        $this->terminarTransaccion(true);
        return $resultados;
    }
}