<?php
namespace Modelos;
//require_once('../config/cargador.php');
use Modelos\Conexion;

class Role {

    public $roleID;
    public $name;

    public function __construct($role = []) {
        $this->roleID = $role['role_id'] ?? 0;
        $this->name = htmlentities($role['name'] ?? '');
    }

    public static function consultar($roleID = 0) {
        $sql = "
            SELECT *
            FROM
                Roles R
            WHERE 1 = 1
        ";
        $parametros = [];
        if (!empty($roleID)) {
            $sql .= " AND role_id = :role_id";
            $parametros['role_id'] = $roleID;
        }
        
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        $roleData = $resultados->fetch();
        return new Role($roleData);
    }
}
?>
