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
            SELECT 1
            FROM
                direcciones 
            WHERE
                P.direccion_id = :direccionId
        ";
        $parametros = [
            'direccionId' => $direccionId
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        $numdirecciones = $resultados->rowCount();
        return 0 < $numdirecciones;
    }

    /**
     * Obtine los resultados de las direcciones de un usuario determinado.
     * Utiliza la siguiente query para realizar la consulta.
     * 
        SELECT D.*, U.nombre_usuario
        FROM
            direcciones D
            JOIN usuarios U ON D.usuario_id = D.usuario_id
        WHERE 1 = 1
            AND usuario_id = :usuarioId
     *      
     * @param int $usuarioId Si el usuarioId es 0 consulta todos los direcciones 
     * en otro caso devuelve solo las direcciones del usuario
     * @return mixed Resultado de la consulta. 
     * 
     */
    public static function listar($usuarioId = 0){
        
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
        
    }

    /**
     * Inserta o actualiza un regitro haciendo uso 
     * de las funciones registrar/actualizar
     * 
     * 
     * @return int|boolean int si fue insercion y un booleano si fue un guardado
     */
    public function guardar() {

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

    }
}