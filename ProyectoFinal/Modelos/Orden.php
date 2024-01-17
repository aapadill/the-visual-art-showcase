<?php
namespace Modelos;
//require_once('../config/cargador.php'); //Comentar para usar en las vistas
use Modelos\Conexion;
use Modelos\OrdenProducto;

/**
$ordenArr = [
    'comprador_id' => 1,
    'direccion_id' => 1
];

$productosArr = [
    [
        'producto_id' => 1,
        'cantidad' => 5,
        'precio_final' => 25
    ],
    [
        'producto_id' => 2,
        'cantidad' => 3,
        'precio_final' => 50
    ],
    [
        'producto_id' => 3,
        'cantidad' => 10,
        'precio_final' => 100
    ]
];

$orden = new Orden($ordenArr, $productosArr);
var_dump($orden);
echo '<br>';
$orden->insertar();
**/

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
        foreach ($this->ordenProductos as $producto) {
            $producto['orden_id'] = $this->ordenId;
            $ordenProducto = new OrdenProducto($producto);
            $indice = $ordenProducto->insertar();
        }
    }

    /**
     * Inserta la Orden y los productos de la orden
     * 
     */
    public function insertar() {
        if (empty($this->ordenId)) {
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

    /**
     * Lista los productos de una orden.
     * Utiliza la siguiente consulta.
     * 
     * SELECT OP.*, P.nombre, P.descripcion, P.precio
     * FROM orden_producto OP
     * JOIN productos P ON OP.producto_id = P.producto_id
     * WHERE orden_id = :ordenId;
     * 
     * @param int $orden_id El ID de la orden para la cual recuperar los productos.
     * Si no se proporciona, se recuperarán todos los productos de todas las órdenes.
     * 
     * @return mixed Resultados de la consulta.
     */
    public static function verProducto($orden_id = null) {
        $sql = "
        SELECT OP.orden_id, OP.producto_id, OP.cantidad, P.nombre, P.descripcion, P.precio as precio_actual, OP.precio_final as precio_final_orden
        FROM orden_producto OP
        JOIN productos P ON OP.producto_id = P.producto_id
        ";

        $parametros = [];

        if ($orden_id !== null) {
            $sql .= " WHERE OP.orden_id = :orden_id";
            $parametros[':orden_id'] = $orden_id;
        }

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        return $resultados;
    }

    /**
     * Detalle de una orden con sus productos.
     * Utiliza la siguiente consulta.
     * 
     * SELECT O.orden_id, O.comprador_id, O.direccion_id, O.status, OP.producto_id, OP.cantidad, OP.precio_final as precio_producto
     * FROM ordenes O
     * JOIN orden_producto OP ON O.orden_id = OP.orden_id
     * WHERE (:orden_id IS NULL OR OP.orden_id = :orden_id);
     * 
     * @param int|null $orden_id El ID de la orden para la cual recuperar detalles. Si es NULL, se obtienen detalles de todas las órdenes.
     * 
     * @return mixed Resultados de la consulta.
     */
    public static function detalleOrden($orden_id = null) {
        $sql = "
            SELECT O.orden_id, O.comprador_id, O.direccion_id, O.status, OP.producto_id, OP.cantidad, OP.precio_final as precio_producto
            FROM ordenes O
            JOIN orden_producto OP ON O.orden_id = OP.orden_id
            WHERE (:orden_id IS NULL OR OP.orden_id = :orden_id);
        ";

        $parametros = [
            ':orden_id' => $orden_id,
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        return $resultados;
    }

    /**
     * Obtiene todos los orden_id asociados a un comprador_id específico.
     * Si no se proporciona un comprador_id, devuelve todos los orden_id.
     * 
     * Utiliza la siguiente consulta.
     * 
     * SELECT DISTINCT orden_id
     * FROM ordenes
     * WHERE (:comprador_id IS NULL OR comprador_id = :comprador_id);
     * 
     * @param int|null $comprador_id El ID del comprador para el cual recuperar orden_id. Si es NULL, se obtienen todos los orden_id.
     * 
     * @return mixed Resultados de la consulta.
     */
    public static function getOrdenIdByCompradorId($comprador_id = null) {
        $sql = "
            SELECT DISTINCT orden_id
            FROM ordenes
            WHERE (:comprador_id IS NULL OR comprador_id = :comprador_id);
        ";

        $parametros = [
            ':comprador_id' => $comprador_id,
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        return $resultados;
    }

    //obtiene los totales
    public static function getTotalByOrden($ordenId) {
        $sql = "
            SELECT SUM(cantidad * precio_final) as total
            FROM orden_producto
            WHERE orden_id = :ordenId
        ";
    
        $parametros = [':ordenId' => $ordenId];
    
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
    
        $total = 0;
    
        while ($row = $resultados->fetch(\PDO::FETCH_ASSOC)) {
            $total = $row['total'];
        }
    
        return $total;
    }

    /**
     * Elimina la orden y sus productos de la base de datos.
     * Debes usar el $this->ordenId como condición para el borrado.
     * 
     * Utiliza la siguiente query para lograrlo
     * 
     * DELETE FROM ordenes WHERE orden_id = :ordenId;
     * DELETE FROM orden_producto WHERE orden_id = :ordenId;
     * 
     * @return mixed true si se borró correctamente
     */
    public function borrar() {
        if (!empty($this->ordenId)) {
            $sqlOrden = "DELETE FROM ordenes WHERE orden_id = :ordenId;";
            $sqlOrdenProducto = "DELETE FROM orden_producto WHERE orden_id = :ordenId;";

            $parametros = [':ordenId' => $this->ordenId];

            $conexion = new Conexion();
            $conexion->correrQuery($sqlOrdenProducto, $parametros);
            $conexion->correrQuery($sqlOrden, $parametros);

            return true;
        }

        return false;
    }
}
?>