<?php
namespace Modelos;
//require_once('../config/cargador.php'); //Comentar para usar en las vistas
use Modelos\Conexion;

class Direccion {

    public $direccionId;
    public $nombre;
    public $calleNumero;
    public $cp;
    public $colonia;
    public $municipio;
    public $estado;
    public $usuarioId;
    
    /**
     * Inicializa las variables de la clase
     * con el arreglo
     * 
     * @param array|int $direccion 
     * array con la siguiente estructura
     * [
        'direccion_id' => 'direccionIdValor' 
        'nombre' => 'nombreValor'
        'calle_numero' => 'calleNumeroValor' 
        'cp' => 'cpValor' 
        'colonia' => 'coloniaValor' 
        'municipio' => 'municipioValor' 
        'estado' => 'estadoValor' 
        'usuario_id' => 'usuarioIdValor' 
     * ]
     */
    public function __construct($direccion = []) {
        $this->direccionId = $direccion['direccion_id'] ?? 0;
        $this->nombre = htmlentities($direccion['nombre'] ?? '');
        $this->calleNumero = htmlentities($direccion['calle_numero'] ?? '');
        $this->cp = htmlentities($direccion['cp'] ?? '');
        $this->colonia = htmlentities($direccion['colonia'] ?? '');
        $this->municipio = htmlentities($direccion['municipio'] ?? '');
        $this->estado = htmlentities($direccion['estado'] ?? '');
        $this->usuarioId = $direccion['usuario_id'] ?? 0;
    }
    
    /**
     * Consulta una direccion por Id
     * utiliza la siguiente query
        SELECT *
        FROM
            direcciones
        WHERE
        direccion_id = :direccion_id
     * 
     * @return Direccion una direccion con valores vacios si no es encontrado
     */
    public static function consultar($direccionId) {
        $sql = "
            SELECT *
            FROM
                direcciones U
            WHERE 1 = 1
        ";
        $parametros = [];

        if (!empty($direccionId)) {
            $sql .= " AND direccion_id = :direccion_id";
            $parametros['direccion_id'] = $direccionId;
        }

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        $direccionDatos = $resultados->fetch();
        return new Direccion($direccionDatos);
    }

    /**
     * Consulta en la Base de datos si existe el direccion
     * 
    SELECT *
    FROM
        direcciones 
    WHERE
        P.direccion_id = :direccionId
     * 
     * @return boolean true Si el direccion Existe en la base de datos 
     */
    public static function existe($direccionId) {
        $sql = "
            SELECT *
            FROM
            direcciones as P
                WHERE
            P.direccion_id = :direccionId
        ";
        $parametros = [
            ':direccionId' => $direccionId,
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        $numDirecciones = $resultados->rowCount();
        return 0 < $numDirecciones;
    }

    /**
     * Consulta en la Base de datos si existe el direccion
     * 
    SELECT *
    FROM
        direcciones 
    WHERE
        P.direccion_id = :direccionId
     * 
     * @return boolean true Si el direccion Existe en la base de datos 
     */
    public static function existe2($nombre, $usuarioId) {
        $sql = "
            SELECT 1
            FROM
                direcciones
            WHERE
                nombre = :nombre
                AND usuario_id = :usuario_id
        ";
        $parametros = [
            'nombre' => $nombre,
            'usuario_id' => $usuarioId
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        $numDirecciones = $resultados->rowCount();
        return 0 < $numDirecciones;
    }

    /**
    *  direccionId getter
    * 
    * @return boolean 
    */
    public static function getDireccionId($nombre, $usuarioId) {
        $sql = "
            SELECT direccion_id
            FROM direcciones
            WHERE nombre = :nombre AND usuario_id = :usuario_id
            LIMIT 1
        ";
        $parametros = [
            ':nombre' => $nombre,
            ':usuario_id' => $usuarioId,
        ];
    
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        $row = $resultados->fetch();
    
        return ($row) ? $row['direccion_id'] : null;
    }

    /**
     * Obtiene los resultados de las direcciones de un usuario determinado.
     * Utiliza la siguiente query para realizar la consulta.
     * 
        SELECT D.*, U.nombre_usuario
        FROM
            direcciones D
            JOIN usuarios U ON D.usuario_id = D.usuario_id
        WHERE 1 = 1
            AND D.usuario_id = :usuarioId
     *      
     * @param int $usuarioId Si el usuarioId es 0 consulta todos los direcciones 
     * en otro caso devuelve solo las direcciones del usuario
     * 
     * @return mixed Resultado de la consulta. 
     * 
     */
    public static function listar($usuarioId = 0){
        $sql = "
        SELECT D.*
        FROM
            direcciones D
        WHERE 1 = 1
            AND D.usuario_id = :usuarioId
        ";

        $parametros = [
            ':usuarioId' => $usuarioId
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        return $resultados;
    }

    /**
     * Listar como admin
     * 
        SELECT D.*, U.nombre_usuario
        FROM
            direcciones D
            JOIN usuarios U ON D.usuario_id = D.usuario_id
        WHERE 1 = 1
            AND D.usuario_id = :usuarioId
     *      
     * @param int $usuarioId Si el usuarioId es 0 consulta todos los direcciones 
     * en otro caso devuelve solo las direcciones del usuario
     * 
     * @return mixed Resultado de la consulta. 
     * 
     */
    public static function listarAdmin(){
        $sql = "
        SELECT D.*, U.nombre_usuario 
            FROM direcciones D 
        JOIN usuarios U ON D.usuario_id = U.usuario_id; 
        ";
    
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql);
    
        return $resultados;
    }


    /**
     * Inserta un registro en la tabla direcciones.
     * Regresa el id Insertado. Adicionalmente 
     * asigna el id al campo $this->direccionId
     * 
     * Utiliza la siguiente query
        INSERT INTO direcciones(nombre, calle_numero, cp, colonia, municipio, estado, usuario_id) VALUES
        (:nombre, :calle_numero, :cp, :colonia, :municipio, :estado, :usuario_id)
        ;
     * 
     * @return int id insertado
     */
    private function insertar(){
        $sql = "
            INSERT INTO direcciones(nombre, calle_numero, cp, colonia, municipio, estado, usuario_id) 
            VALUES (:nombre, :calle_numero, :cp, :colonia, :municipio, :estado, :usuario_id)
        ";
        $parametros = [
            ':nombre' => $this->nombre,
            ':calle_numero' => $this->calleNumero,
            ':cp' => $this->cp,
            ':colonia' => $this->colonia,
            ':municipio' => $this->municipio,
            ':estado' => $this->estado,
            ':usuario_id' => $this->usuarioId,
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        // Obtener el ID insertado y asignarlo a la propiedad $this->direccionId
        $this->direccionId = $conexion->lastInsertId();
        return $resultados;
    }

    /**
     * Actualiza un registro de direcciones
     * Utiliza la siguiene query para lograrlo
     * 
        UPDATE direcciones
        SET
            nombre = :nombre, 
            calle_numero = :calle_numero, 
            cp = :cp, 
            colonia = :colonia, 
            municipio = :municipio, 
            estado = :estado, 
            usuario_id = :usuario_id
        WHERE
            direccion_id = :direccionId
     *
     * @return boolean true Si se actualizo con exito 
     */
    private function actualizar() {
        $sql = "
            UPDATE direcciones
            SET
                nombre = :nombre, 
                calle_numero = :calle_numero, 
                cp = :cp, 
                colonia = :colonia, 
                municipio = :municipio, 
                estado = :estado, 
                usuario_id = :usuario_id
            WHERE
                direccion_id = :direccionId
        ";
        $parametros = [
            ':direccionId' => $this->direccionId,
            ':nombre' => $this->nombre,
            ':calle_numero' => $this->calleNumero,
            ':cp' => $this->cp,
            ':colonia' => $this->colonia,
            ':municipio' => $this->municipio,
            ':estado' => $this->estado,
            ':usuario_id' => $this->usuarioId,
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }

    /**
     * Si existe una direccion con el mismo nombre y usuario
     *      Se obtiene direccionId del match
     *      Se actualiza direccionId (deja de ser el default del construct (era 0))
     *      Se actualiza la tabla (a traves del direccionId que coincidio)
     * 
     * @return int|boolean int si fue insercion y un booleano si fue un guardado
     */
    public function guardar() {
        if (self::existe($this->direccionId)) {
            return $this->actualizar();
        } else {
            return $this->insertar();
        }
    }

    /**
     * Si existe una direccion con el mismo nombre y usuario la sobreescribe usando el mismo id de direccion
    */
    public function guardar2() {
        if (self::existe2($this->nombre, $this->usuarioId)) { //podrias cambiar el parametro por una bandera que recibes desde afuera, existeNombreDireccion
            $this->direccionId = self::getDireccionId($this->nombre, $this->usuarioId);
            return $this->actualizar();
        } else {
            return $this->insertar();
        }
    }

    public static function contar($direccion) {
        return $direccion->rowCount();
    }

    /**
     * Elimina la direccion de la base de datos.
     * Debes usar el $this->direccionId 
     * como condicion para el borrado.
     * 
     * Utiliza la siguiente query para lograrlo
     * 
        DELETE FROM
            direcciones
        WHERE
            direccion_id = :direccionId
     * 
     * @return boolean true si se borro correctamente
     */
    public function borrar() {
        $sql = "
        DELETE FROM
            direcciones
        WHERE
            direccion_id = :direccionId
        ";

        $parametros = [
            ':direccionId' => $this->direccionId
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        return $resultados;
    }
}