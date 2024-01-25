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
    public $isSubscribed;

    public function __construct($usuario = []) {
        $this->userID = $usuario['user_id'] ?? 0;
        $this->username = htmlentities($usuario['username'] ?? '');
        $this->email = htmlentities($usuario['email'] ?? '');
        $this->password = htmlentities($usuario['password'] ?? '');
        $this->profilePicture = htmlentities($usuario['profile_picture'] ?? '');
        $this->name = htmlentities($usuario['name'] ?? '');
        $this->bio = htmlentities($usuario['bio'] ?? '');
        $this->location = htmlentities($usuario['location'] ?? '');
        $this->roleID = htmlentities($usuario['role_id'] ?? 1);
        $this->isSubscribed = htmlentities($usuario['is_subscribed'] ?? 0);
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
        // echo "SQL Query: " . $sql;
        // echo "Parameters: ";
        // print_r($parametros);
        
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        $usuarioDatos = $resultados->fetch();
        return new Usuario($usuarioDatos);
    }

    public static function userExists($userID) {
        $sql = "
            SELECT user_id
            FROM
                Users U
            WHERE
                U.user_id = :usuarioId
        ";
        $parametros = [
            'usuarioId' => $userID
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        $numUsuarios = $resultados->rowCount();
        return 0 < $numUsuarios;
    }

    public static function checkUsernameOrEmail($username, $email) {
        $sql = "
            SELECT username, email
            FROM
                Users U
            WHERE
                U.username = :username OR U.email = :email
        ";
        $parametros = [
            'username' => $username,
            'email' => $email
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
    
        if ($resultados->rowCount() > 0) {
            $user = $resultados->fetch();
            if ($user['username'] === $username) {
                return 'Username already taken';
            }
            if ($user['email'] === $email) {
                return 'Email already registered';
            }
        }
        return 1;
    }
    
    //breaking encapsulation with this being public? not really.. 
    //this is how the real world interacts with the function, right?..
    public function insertar() {
        $sql = "
            INSERT INTO Users (username, password, email, name, profile_picture, role_id, is_subscribed) 
            VALUES
                (:username, :password, :email, :name, :profile_picture, :role_id, :is_subscribed)
            ";
        $parametros = [
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => $this->password,
            ':name' => $this->name,
            ':profile_picture' => $this->profilePicture,
            ':role_id' => $this->roleID,
            ':is_subscribed' => $this->isSubscribed,
        ];
        $conexion = new Conexion();
        $conexion->correrQuery($sql, $parametros, true);
        return $conexion->lastInsertId();
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

    public function actualizar() {
        $sql = "
            UPDATE Users
            SET
                username = :username,
                email = :email,
                password = :password,
                name = :name,
                profile_picture = :profile_picture,
                role_id = :role_id,
                is_subscribed = :is_subscribed
            WHERE
                user_id = :user_id
            ";
        $parametros = [
            ':user_id' => $this->userID,
            ':username' => $this->username,
            ':email' => $this->email,
            ':password' => $this->password,
            ':name' => $this->name,
            ':profile_picture' => $this->profilePicture,
            ':role_id' => $this->roleID,
            ':is_subscribed' => $this->isSubscribed,
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }
    
    public function actualizarSuscripcion() {
        $sql = "
            UPDATE Users
            SET
                is_subscribed = :is_subscribed
            WHERE
                user_id = :user_id
            ";
        $parametros = [
            ':user_id' => $this->userID,
            ':is_subscribed' => $this->isSubscribed,
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }

    public static function listar() {
        $sql = "
            SELECT *
            FROM
            Users U
        ";
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql);

        $usuarios = [];
        while ($fila = $resultados->fetch()) {
            $usuarios[] = new Usuario($fila);
        }
        return $usuarios;
    }
    

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