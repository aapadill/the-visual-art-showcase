<?php
namespace Modelos;
//require_once('../config/cargador.php'); //Comentar para usar en las vistas
use Modelos\Conexion;

class Usuario {

    public $userID;
    public $username;
    public $email;
    public $password;
    public $profilePicture;
    public $name;
    public $bio;
    public $location;
    public $roleID;

    public function __construct($usuario = []) {
        $this->userID = $usuario['user_id'] ?? 0;
        $this->username = htmlentities($usuario['username'] ?? '');
        $this->email = htmlentities($usuario['email'] ?? '');
        $this->password = htmlentities($usuario['password'] ?? '');
        $this->profilePicture = htmlentities($usuario['profile_picture'] ?? '');
        $this->name = htmlentities($usuario['name'] ?? '');
        $this->bio = htmlentities($usuario['bio'] ?? '');
        $this->location = htmlentities($usuario['location'] ?? '');
        $this->roleID = htmlentities($usuario['role_id'] ?? 3);
    }

    public static function consultar($userID = 0, $username = '') {
        $sql = "
            SELECT *
            FROM
                Users U
            WHERE 1 = 1
        ";
        $parametros = [];
        if (!empty($userID)) {
            $sql .= " AND user_id = :user_id";
            $parametros['user_id'] = $userID;
        }

        if (!empty($username)) {
            $sql .= " AND username = :username";
            $parametros['username'] = $username;
        }
        
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        $usuarioDatos = $resultados->fetch();
        return new Usuario($usuarioDatos);
    }

    // public static function existe($userID) {
    //     $sql = "
    //         SELECT *
    //         FROM
    //             Users U
    //         WHERE
    //             U.user_id = :usuarioId
    //     ";
    //     $parametros = [
    //         'usuarioId' => $userID
    //     ];
    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);
    //     $numUsuarios = $resultados->rowCount();
    //     return 0 < $numUsuarios;
    // }

    // public static function listar() {
    //     $sql = "
    //         SELECT U.usuario_id, U.nombre_usuario, U.email, U.nombre, U.img_usuario, U.password, R.rol_id, R.nombre rol_nombre
    //         FROM
    //             usuarios U
    //             JOIN roles R ON R.rol_id = U.rol_id
    //     ";
    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql);

    //     return $resultados;
    // }

    // private function insertar(){
    //     $sql = "
    //         INSERT INTO usuarios (nombre_usuario, password, email, nombre, img_usuario, rol_id) 
    //         VALUES
    //             (:nombreUsuario, :password, :email, :nombre, :img_usuario, :rol_id)
    //         ";
    //     $parametros = [
    //         ':nombreUsuario' => $this->nombreUsuario,
    //         ':email' => $this->email,
    //         ':password' => $this->password,
    //         ':nombre' => $this->nombre,
    //         ':img_usuario' => $this->imgUsuario,
    //         ':rol_id' => $this->rolId,
    //     ];
    //     $conexion = new Conexion();

    //     $resultados = $conexion->correrQuery($sql, $parametros);
    //     return $resultados;
    // }

    // private function actualizar() {
    //     $sql = "
    //         UPDATE usuarios
    //         SET
    //             nombre_usuario = :nombreUsuario,
    //             email = :email,
    //             password = :password,
    //             nombre = :nombre,
    //             img_usuario = :img_usuario,
    //             rol_id = :rol_id
    //         WHERE
    //             usuario_id = :usuarioId
    //         ";
    //     $parametros = [
    //         ':usuarioId' => $this->usuarioId,
    //         ':nombreUsuario' => $this->nombreUsuario,
    //         ':email' => $this->email,
    //         ':password' => $this->password,
    //         ':nombre' => $this->nombre,
    //         ':img_usuario' => $this->imgUsuario,
    //         ':rol_id' => $this->rolId,
    //     ];
    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);
    //     return $resultados;
    // }

    // public function guardar() {
    //     if (self::existe($this->usuarioId)) {
    //         return $this->actualizar();
    //     } else {
    //         return $this->insertar(); 
    //     }
    // }

    // public function borrar() {
    //     $sql = "
    //     DELETE FROM
    //         usuarios
    //     WHERE
    //         usuario_id = :usuarioId
    //     ";

    //     $parametros = [
    //         ':usuarioId' => $this->usuarioId
    //     ];

    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);

    //     return $resultados;
    // }

    // public function actualizarRol($rolId) {
    //     $sql = "
    //     UPDATE usuarios
    //     SET
    //       rol_id = :rol_id
    //     WHERE
    //         usuario_id = :usuario_id
    //     ";
    //     $parametros = [
    //         ':rol_id' => $rolId,
    //         ':usuario_id' => $this->usuarioId
    //     ];
    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);
    //     return $resultados;
    // }

    public static function listarRoles() {
        $sql = "
            SELECT role_id, name
            FROM
                Roles
            ";
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql);

        return $resultados;
    }

    public static function validarLogin($username, $password) {
        $res = '';
        $usuario = self::consultar(0, $username);

        if (empty($usuario->userID)) {
            $res = 'Usuario invalido';
        } else {
            if ($usuario->password !== $password) {
                $res = 'Password Invalido';
            } else {
                $res = $usuario;
            }
        }
        return $res;
    }

    // public static function getUserByRolId($rol_id = 0) {
    //     $sql = "
    //         SELECT usuario_id, nombre_usuario
    //         FROM usuarios
    //         WHERE (:rol_id = 0 OR rol_id = :rol_id)
    //     ";

    //     $parametros = [
    //         ':rol_id' => $rol_id,
    //     ];

    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);

    //     return $resultados;
    // }
}
?>