<?php
namespace Modelos;
//require_once('../config/cargador.php'); //Comentar para usar en las vistas
use Modelos\Conexion;

class Usuario {

    public $usuarioId;
    public $nombreUsuario;
    public $email;
    public $password;
    public $nombre;
    public $imgUsuario;
    public $rolId;
    
    /**
     * Inicializa las variables de la clase
     * con el arreglo dado
     * 
     * @param array|int $usuario 
     * array con la siguiente estructura
     * [
        'usuario_id' => 'usuario_idValor'
        'nombre_usuario' => 'nombreUsuarioValor'
        'email' => 'emailValor'
        'password' => 'passwordValor'
        'nombre' => 'nombreValor'
        'img_usuario' => 'img_usuarioValor'
        'rol_id' => 'rol_idValor'
     * ]
     */
    public function __construct($usuario = []) {
        $this->usuarioId = $usuario['usuario_id'] ?? 0;
        $this->nombreUsuario = htmlentities($usuario['nombre_usuario'] ?? '');
        $this->email = htmlentities($usuario['email'] ?? '');
        $this->password = htmlentities($usuario['password'] ?? '');
        $this->nombre = htmlentities($usuario['nombre'] ?? '');
        $this->imgUsuario = htmlentities($usuario['img_usuario'] ?? '');
        $this->rolId = htmlentities($usuario['rol_id'] ?? 3);
    }

    /**
     * Consulta un usuario por Id o Por Nombre de usuario.
     * 
     * @return Usuario un usuario con valores vacios si no es encontrado
     */
    public static function consultar($usuarioId = 0, $nombreUsuario = '') {
        $sql = "
            SELECT *
            FROM
                usuarios U
            WHERE 1 = 1
        ";
        $parametros = [];
        if (!empty($usuarioId)) {
            $sql .= " AND usuario_id = :usuario_id";
            $parametros['usuario_id'] = $usuarioId;
        }

        if (!empty($nombreUsuario)) {
            $sql .= " AND nombre_usuario = :nombre_usuario";
            $parametros['nombre_usuario'] = $nombreUsuario;
        }
        

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        $usuarioDatos = $resultados->fetch();
        return new Usuario($usuarioDatos);
    }

    /**
     * Consulta en la Base de datos si existe el usuario
     * 
    SELECT *
    FROM
        usuarios U
    WHERE
        U.usuario_id = :usuarioId
     * 
     * @return boolean true Si el Usuario Existe en la base de datos 
     */
    public static function existe($usuarioId) {
        $sql = "
            SELECT *
            FROM
                usuarios U
            WHERE
                U.usuario_id = :usuarioId
        ";
        $parametros = [
            'usuarioId' => $usuarioId
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        $numUsuarios = $resultados->rowCount();
        return 0 < $numUsuarios;
    }

    /**
     * Obtine los datos de todos los usuarios
     * Utiliza la siguiente query para realizar la consulta.
     * 
        SELECT U.usuario_id, U.nombre_usuario, U.email, U.nombre, U.img_usuario, U.password, R.rol_id, R.nombre rol_nombre
        FROM
            usuarios U
            JOIN roles R ON R.rol_id = U.rol_id
        ; 
     *      
     * @param int $usuarioId usuario_id de las direcciones
     * @return mixed de la consulta. 
     * 
     */
    public static function listar() {
        $sql = "
            SELECT U.usuario_id, U.nombre_usuario, U.email, U.nombre, U.img_usuario, U.password, R.rol_id, R.nombre rol_nombre
            FROM
                usuarios U
                JOIN roles R ON R.rol_id = U.rol_id
        ";
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql);

        return $resultados;
    }

    /**
     * Inserta un registro en la tabla direcciones.
     * Regresa el id Insertado. Adicionalmente 
     * asigna el id al campo $this->usuarioId
     * 
     * Utiliza la siguiente query
        INSERT INTO usuarios (nombre_usuario, password, email, nombre, img_usuario, rol_id) VALUES
          ('admin', 'Hola1234', 'test@test.com', 'Admin', './img/usuarios/user.png', 1)
        ;
     * 
     * @return int id insertado
     */
    private function insertar(){
        $sql = "
            INSERT INTO usuarios (nombre_usuario, password, email, nombre, img_usuario, rol_id) 
            VALUES
                (:nombreUsuario, :password, :email, :nombre, :img_usuario, :rol_id)
            ";
        $parametros = [
            ':nombreUsuario' => $this->nombreUsuario,
            ':email' => $this->email,
            ':password' => $this->password,
            ':nombre' => $this->nombre,
            ':img_usuario' => $this->imgUsuario,
            ':rol_id' => $this->rolId,
        ];
        $conexion = new Conexion();

        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }

    /**
     * Actualiza un registro de la tabla usuarios
     * Utiliza la siguiene query para lograrlo
     * 
        UPDATE usuarios
        SET
            nombre_usuario = :nombreUsuario,
            email = :email,
            password = :password,
            nombre = :nombre,
            img_usuario = :img_usuario,
            rol_id = :rol_id
        WHERE
            usuario_id = :usuarioId
     *
     * @return boolean true Si se guardo con exito 
     */
    private function actualizar() {
        $sql = "
            UPDATE usuarios
            SET
                nombre_usuario = :nombreUsuario,
                email = :email,
                password = :password,
                nombre = :nombre,
                img_usuario = :img_usuario,
                rol_id = :rol_id
            WHERE
                usuario_id = :usuarioId
            ";
        $parametros = [
            ':usuarioId' => $this->usuarioId,
            ':nombreUsuario' => $this->nombreUsuario,
            ':email' => $this->email,
            ':password' => $this->password,
            ':nombre' => $this->nombre,
            ':img_usuario' => $this->imgUsuario,
            ':rol_id' => $this->rolId,
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }

    /**
     * Inserta o actualiza un regitro de la tabla usuarioshaciendo uso 
     * de las funciones registrar/actualizar
     * 
     * 
     * @return int|boolean int si fue insercion y un booleano si fue un guardado
     */
    public function guardar() {
        if (self::existe($this->usuarioId)) {
            return $this->actualizar();
        } else {
            return $this->insertar(); 
        }
    }

    /**
     * Elimina la direccion de la base de datos.
     * Debes usar el $this->usuarioId 
     * como condicion para el borrado.
     * 
     * Utiliza la siguiente query para lograrlo
     * 
        DELETE FROM
            usuarios
        WHERE
            usuario_id = :usuarioId
     * 
     * @return boolean true si se borro correctamente
     */
    public function borrar() {
        $sql = "
        DELETE FROM
            usuarios
        WHERE
            usuario_id = :usuarioId
        ";

        $parametros = [
            ':usuarioId' => $this->usuarioId
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        return $resultados;
    }

    /**
     * Actualiza un registro de la tabla usuarios
     * Utiliza la siguiene query para lograrlo
     * 
        UPDATE usuarios
        SET
          rol_id = :rol_id
        WHERE
            usuario_id = :usuario_id
     *
     *  @param int $rolId Nuevo rol Asignado
     *  @return boolean true Si se actualiaz con exito
     */
    public function actualizarRol($rolId) {
        $sql = "
        UPDATE usuarios
        SET
          rol_id = :rol_id
        WHERE
            usuario_id = :usuario_id
        ";
        $parametros = [
            ':rol_id' => $rolId,
            ':usuario_id' => $this->usuarioId
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }

    /**
     * Obtine los resultados de las direcciones de un usuario determinado.
     * Utiliza la siguiente query para realizar la consulta.
     * 
      SELECT rol_id, nombre
      FROM
        roles
      ;
     *
     * @return mixed
     * 
     */
    public static function listarRoles() {
        $sql = "
            SELECT rol_id, nombre
            FROM
                roles
            ";
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql);

        return $resultados;
    }

    /**
      * Verifica que el usuairo y Contrasenia correspondan a un usuario
      * y regresa los datos del usuario.
      * Primero deberas obtener el usuario y posteriormente verificar
      * que el password de la BD corresponda con el parametro $password
      *
      * Utiliza la query 
      SELECT  usuario_id, nombre_usuario, email, nombre, img_usuario, password, rol_id
      FROM usuarios
      WHERE
        nombre_usuario = 'leon'
      *  
      * @return string|Usuario regresa un objeto de tipo usuario en caso que el 
      *  $nombreUsuario y $password coincidan
      *  str con el mensaje "Usuario invalido" en caso que el usuario no este en la base de datos 
      *  str con el mensaje 'Password Invalido' en caso que el password no coincida
      */
    public static function validarLogin($nombreUsuario, $password) {
        $res = '';
        $usuario = self::consultar(0, $nombreUsuario);

        if (empty($usuario->usuarioId)) {
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
}
?>