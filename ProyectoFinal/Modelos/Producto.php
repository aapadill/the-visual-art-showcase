<?php
namespace Modelos; //belongs to Modelos
//require_once('../config/cargador.php'); //Comentar para usar en las vistas
use Modelos\Conexion;

class Producto {

    public $productoId;
    public $nombre;
    public $descripcion;
    public $precio;
    public $imgProducto;
    public $vendedorId;
    
    /**
     * Inicializa las variables de la clase
     * con el arreglo o consulta en la base de datos
     * con el id proveido e inicializa las variables del producto.
     * 
     * 
     * @param array|int $producto 
     * int Id de de la direccion
     * array con la siguiente estructura
     * [
        'producto_id' => 'producto_idValor'
        'nombre' => 'nombreValor'
        'descripcion' => 'descripcion'
        'precio' => 23.5
        'vendedor_id' => 'vendedor'
        'img_producto' => 'img_productoValor'
        'rol_id' => 'rol_idValor'
     * ]
     */
    public function __construct($producto = []) {
        $this->productoId = $producto['producto_id'] ?? 0;
        $this->nombre = htmlentities($producto['nombre'] ?? '');
        $this->descripcion = htmlentities($producto['descripcion'] ?? '');
        $this->precio = $producto['precio'] ?? 0.0;
        $this->imgProducto = htmlentities($producto['img_producto'] ?? '');
        $this->vendedorId = $producto['vendedor_id'] ?? 0;
    }

    /**
     * Consulta un producto por Id
     * utiliza la siguiente query
    SELECT *
    FROM
        productos
    WHERE
         producto_id = :producto_id
     * 
     * @return Producto un producto con valores vacios si no es encontrado
     */
    public static function consultar($productoId) {
        $sql = "
            SELECT *
            FROM
                productos
            WHERE
            producto_id = :producto_id
        ";
        $parametros = [
            'producto_id' => $productoId
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        $productoDatos = $resultados->fetch();
        return new Producto($productoDatos);
    }

    /**
     * Consulta en la Base de datos si existe el producto
     * 
    SELECT *
    FROM
        productos P
    WHERE
        P.producto_id = :productoId
     * 
     * @return boolean true Si el producto Existe en la base de datos 
     */
    public static function existe($productoId) {
        $sql = "
            SELECT 1
            FROM
                productos P
            WHERE
                P.producto_id = :productoId
        ";
        $parametros = [
            'productoId' => $productoId
        ];
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        $numproductos = $resultados->rowCount();
        return 0 < $numproductos;
    }

    /**
     * Obtine los resultados de los productos.
     * Utiliza la siguiente query para realizar la consulta.
     * 
        SELECT P.producto_id, P.nombre, P.descripcion, P.precio, P.img_producto
        FROM
            productos P
        WHERE
            1 = 1
            AND (lower(nombre) LIKE CONCAT('%', lower(:busqueda),  '%')  OR lower(descripcion) LIKE CONCAT('%', lower(:busqueda),  '%')) 
        ; 
     *      
     * @param int $busqueda Texto a Buscar
     * en otro caso devuelve todos los productos
     * @return mixed Resulatdo de la consulta. 
     * 
     */
    public static function buscar($busqueda = '') {
        $sql = "
        SELECT P.producto_id, P.nombre, P.descripcion, P.precio, P.img_producto
        FROM
            productos P
        WHERE
            1 = 1
        ";
        $parametros = [];

        if (!empty($busqueda)) {
            $sql .= " AND (lower(nombre) LIKE CONCAT('%', lower(:busqueda),  '%')  OR lower(descripcion) LIKE CONCAT('%', lower(:busqueda),  '%'))";
            $parametros['busqueda'] = $busqueda;
        }
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }

    /**
     * Obtine los resultados de los productos.
     * Utiliza la siguiente query para realizar la consulta.
     * 
        SELECT P.producto_id, P.nombre, P.descripcion, P.precio, P.img_producto, P.vendedor_id, U.nombre_usuario
        FROM
            productos P
            JOIN usuarios U ON P.vendedor_id = U.usuario_id
        WHERE
            1 = 1
        ; 
     *      
     * @param int $vendedorId Si el vendedorId es 0 consulta todos los productos 
     * en otro caso devuelve solo los productos del vendedor
     * @return mixed Resultado de la consulta. 
     * 
     */
    public static function listar($vendedorId = 0) {
        $sql = "
            SELECT P.*, U.nombre_usuario
            FROM
                productos P
            JOIN usuarios U ON P.vendedor_id = U.usuario_id
            WHERE
                1 = 1
            AND (:vendedorId = 0 OR P.vendedor_id = :vendedorId)
        ";
    
        $parametros = [
            ':vendedorId' => $vendedorId
        ];
    
        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
    
        return $resultados;
    }

    /**
     * Lista Todos los productos de una orden
     * utiliza la siquiente query para lorarlo
     * 
     SELECT SUM(precio_final * cantidad) as total
     FROM
         orden_producto
     WHERE
        orden_id = :ordenId
     * 
     * @return mixed Total de la compra
     */
    public static function total($ordenId) {
        $sql = "
            SELECT SUM(precio_final * cantidad) as total
            FROM
                orden_producto
            WHERE
                orden_id = :ordenId
        ";

        $parametros = [
            ':ordenId' => $ordenId
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        $totalCompra = $resultados->fetchColumn();
        return $totalCompra;
    }

    /**
     * Inserta un registro en la tabla direcciones.
     *    
     * Utiliza la siguiente query
        INSERT INTO productos (nombre, descripcion, precio, img_producto, vendedor_id) VALUES
          ('libro', 'Hola1234', 123, './img/productos/user.png', 2)
        ;
     * 
     * @return int id insertado
     */
    private function insertar(){
        $sql = "
            INSERT INTO productos (nombre, descripcion, precio, img_producto, vendedor_id)
            VALUES (:nombre, :descripcion, :precio, :imgProducto, :vendedorId)
        ";
        
        $parametros = [
            ':nombre' => $this->nombre,
            ':descripcion' => $this->descripcion,
            ':precio' => $this->precio,
            ':imgProducto' => $this->imgProducto,
            ':vendedorId' => $this->vendedorId,
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        // Obtener el ID insertado y asignarlo a la propiedad $this->productoId
        $this->productoId = $conexion->lastInsertId();
        return $resultados;
    }

    /**
     * Actualiza un registro de la tabla productos
     * Utiliza la siguiene query para lograrlo
     * 
        UPDATE productos
        SET
            nombre = :nombre,
            descripcion = :descripcion,
            precio = :precio,
            img_producto = :img_producto,
            vendedor_id = :vendedor_id
        WHERE
            producto_id = :productoId
     *
     * @return boolean true Si se guardo con exito 
     */
    private function actualizar() {
        $sql = "
            UPDATE productos
            SET
                nombre = :nombre,
                descripcion = :descripcion,
                precio = :precio,
                img_producto = :imgProducto,
                vendedor_id = :vendedorId
            WHERE
                producto_id = :productoId
        ";
        
        $parametros = [
            ':productoId' => $this->productoId,
            ':nombre' => $this->nombre,
            ':descripcion' => $this->descripcion,
            ':precio' => $this->precio,
            ':imgProducto' => $this->imgProducto,
            ':vendedorId' => $this->vendedorId,
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }

    /**
     * Inserta o actualiza un regitro de la tabla productoshaciendo uso 
     * de las funciones registrar/actualizar
     * 
     * 
     * @return int|boolean int si fue insercion y un booleano si fue un guardado
     */
    public function guardar() {
        if (self::existe($this->productoId)) {
            return $this->actualizar();
        } else {
            return $this->insertar(); 
        }
    }

    /**
     * Elimina la direccion de la base de datos.
     * Debes usar el $this->productoId 
     * como condicion para el borrado.
     * 
     * Utiliza la siguiente query para lograrlo
     * 
        DELETE FROM
            productos
        WHERE
            producto_id = :productoId
     * 
     * @return mixed true si se borro correctamente
     */
    public function borrar() {
        $sql = "
            DELETE FROM
                productos
            WHERE
                producto_id = :productoId
        ";

        $parametros = [
            ':productoId' => $this->productoId,
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }

    /**
     * Actualiza el precio de un producto
     * 
     * Utiliza la siguiente query para lograrlo
     * 
        UPDATE
            productos
        SET
            precio = :precio
        WHERE
            producto_id = :productoId
     * 
     * @return mixed true se actualizo correctamente
     */
    public function actualizarPrecio($precio) {
        $sql = "
            UPDATE
                productos
            SET
                precio = :precio
            WHERE
                producto_id = :productoId
        ";

        $parametros = [
            ':precio' => $precio,
            ':productoId' => $this->productoId,
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);
        return $resultados;
    }
}
