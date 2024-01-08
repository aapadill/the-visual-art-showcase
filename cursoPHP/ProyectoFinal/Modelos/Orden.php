<?php
namespace Modelos;
// require_once('../config/cargador.php'); //Comentar para usar en las vistas
use Modelos\Conexion;

class Orden {
	
	public $ordenId;
	public $compradorId;
	public $direccionId;
	public $status;
    public $ordenProductos;

    /**
     * Inicializa los atributos de la clase con el arreglo
     * Adicionalmente agrega los producto a la orden
     * 
     * @param array $orden Orden con la siguinete estructura
     *
     [
        'orden_id' => 'orden',
        'status' => 'status',
        'comprador_id' => 'usuario_id',
        'direccion_id' => 'direccion_id'
     ]
     * @param array $ordenProductos Lista de productos que se agregaran a la orden
     */
    public function __construct($orden = [], $ordenProductos = []) {
        $this->ordenId = $orden['orden_id'] ?? 0;
        $this->status = $orden['status'] ?? 'Pagada';
        $this->direccionId = $orden['direccion_id'] ?? 0;
        $this->compradorId = $orden['comprador_id'] ?? 0;
        $this->ordenProductos = $ordenProductos;
    }

    /**
     * Inserta una orden y regresa el Id insertado
     * adicionalmente $this->ordenId es asignado como el Id insertado
     * 
     * Utiliza la siguiente consulta
     INSERT INTO ordenes (comprador_id, direccion_id, status) 
            VALUES
                (:compradorId, :direccionId, :status)
     *
     * @return int Id insertado       
     */
    private function insertarOrden() {
        $sql = "
            INSERT INTO ordenes (comprador_id, direccion_id, status) 
            VALUES
                (:compradorId, :direccionId, :status)
            ";
        $parametros = [
            ':status' => $this->status,
            ':direccionId' => $this->direccionId,
            ':compradorId' => $this->compradorId
        ];
        $conexion = new Conexion();

        $this->ordenId = $conexion->correrQuery($sql, $parametros, true);
        return $this->ordenId;
    }

    /**
     * Inserta los Productos 
     * Agrega el ordenId a los productos para no 
     */
    private function insertarOrdenProductos() {
        
    }

    /**
     * Inserta la Orden y los productos de la orden
     * 
     */
    public function insertar() {
        if (empty($this->ordenId)) {
            echo 'Orden';
            $this->insertarOrden();
        }

        $this->insertarordenProductos();

    }

    /**
     * Actualiza el status de la orden
     * a Enviada
     * Utiliza la siguiente query para lograrlo
     * 
     UPDATE ordenes
     SET 
        status = 'Enviada',
        fecha_entrega = NOW()
     WHERE
        orden_id = :ordenId
     */
    public function enviarOrden() {

    }

}

?>