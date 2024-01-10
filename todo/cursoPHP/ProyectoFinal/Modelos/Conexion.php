<?php
namespace Modelos;
// 

$conexion = new Conexion();
$sql = "SELECT * FROM USUARIOS WHERE usuario_id = :usuario_id;";

$resultados = $conexion->prepare($sql);
$parametros = [':usuario_id' => 1];

$resultados->execute($parametros);
//$resultados->setFetchMode(PDO::FETCH_ASSOC); //not working

foreach ($resultados as $usuario){
    echo '<pre>';
    var_dump($usuario);
    echo '<pre>';
}

//use Modelos\Conexion;
class Conexion extends \PDO{ //implements Persistente 
    public static $host = "localhost";
    public static $port = "3306";
    public static $user = "root";
    public static $pass = null;
    public static $dbname = "tienda";

    function  __construct() {
        try {
            //calls the parent constructor (PDO's), which expects 3 arguments: @DSN (Data Source Name), @username and @password
            //@DSN is "mysql:host=localhost;port=3306;dbname=tienda"
            //@username is "root"
            //@password is "null"
            parent::__construct("mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname, self::$user, self::$pass);
        } catch (\PDOException $e) { //catches any exception of the PDOException type
            die("No se pudo conectar: " . $e->getMessage());
        }
    }

    public function cerrarConexion() { //nothing really since PDO handles the closing of the connection
       return true;
    }

    public function empezarTransaccion(){
        return $this->beginTransaction(); //inhered from PDO, starts transaction, returns a boolean
    }

    public function terminarTransaccion($success){
        if ($success) {
            $this->commit(); //inhered from PDO, saves changes from the transaction, returns a boolean
        } else {
            $this->rollBack(); //inhered from PDO, discards changes from the transaction, returns a boolean
        }
        $this->cerrarConexion(); //not sure if this is necessary at all but ok
    }

    public function correrQuery($sql, $params = [], $esInsert = false) {
        $correcto = $this->empezarTransaccion();
        if (empty($correcto)) {
            return false;
        }
        $resultados = parent::prepare($sql); //duda, porque aqui se especifica la herencia?
        if (empty($resultados)) {
            $this->terminarTransaccion(false);
            return false;
        }
        $correcto = $resultados->execute($params);
        $resultados->setFetchMode(\PDO::FETCH_ASSOC);
        if (!empty($esInsert) && $correcto) {
            $resultados = parent::lastInsertId();
        }
        $this->terminarTransaccion(true);
        return $resultados;
    }
}