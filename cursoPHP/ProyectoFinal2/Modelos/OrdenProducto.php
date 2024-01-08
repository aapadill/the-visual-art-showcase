<?php
namespace Modelos;
// require_once('../config/cargador.php'); //Comentar para usar en las vistas
use Modelos\Conexion;

class OrdenProducto {
	
	public $ordenProductoId;
	public $ordenId;
	public $productoId;
	public $precioFinal;
    public $cantidad;

    /**
     * Inicializa los atributos de la clase con el arreglo
     * Adicionalmente agrega los producto a la orden
     * 
     * @param array $orden Orden con la siguinete estructura
     *
     [
        'orden_producto_id' => 'status',
        'producto_id' => 'status',
        'orden_id' => 'usuario_id',
        'precio_final' => 'direccion_id',
        'cantidad' => 'cantidad'
     ]
     * @param array $ordenProductos Lista de productos que se agregaran a la orden
     */
    public function __construct($orden = []) {
        $this->ordenProductoId = $orden['orden_producto_id'] ?? 0;
        $this->ordenId = $orden['orden_id'] ?? 0;
        $this->productoId = $orden['producto_id'] ?? 0;
        $this->precioFinal = $orden['precio_final'] ?? 0;
        $this->cantidad = $orden['cantidad'] ?? 0;
    }

    /**
     * Lista Todos los productos de una orden
     * utiliza la siquiente query para lorarlo
     * 
     SELECT *
     FROM
         orden_producto
     WHERE
        orden_id = :ordenId
     * 
     */
    public static function listar($ordenId) {

    }

    /**
     * Utiliza la siguiente query para insertar los datos
     INSERT INTO orden_producto(orden_id, producto_id, precio_final, cantidad) VALUES
        (:ordenId, :productoId, :precioFinal, :cantidad)
     * 
     */
    public function insertar() {
        $sql = "
        INSERT INTO orden_producto(orden_id, producto_id, precio_final, cantidad) VALUES
        (:ordenId, :productoId, :precioFinal, :cantidad)
        ;";
        $parametros = [
            ':ordenId' => $this->ordenId, 
            ':productoId' => $this->productoId, 
            ':precioFinal' => $this->precioFinal, 
            ':cantidad' => $this->cantidad
        ];

        $conexion = new Conexion();
        $conexion->correrQuery($sql, $parametros, true);
    }

}

?>