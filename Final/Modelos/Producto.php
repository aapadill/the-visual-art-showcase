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
    
    public function __construct($producto = []) {
        $this->productoId = $producto['producto_id'] ?? 0;
        $this->nombre = htmlentities($producto['nombre'] ?? '');
        $this->descripcion = htmlentities($producto['descripcion'] ?? '');
        $this->precio = $producto['precio'] ?? 0.0;
        $this->imgProducto = htmlentities($producto['img_producto'] ?? '');
        $this->vendedorId = $producto['vendedor_id'] ?? 0;
    }

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

    public function guardar() {
        if (self::existe($this->productoId)) {
            return $this->actualizar();
        } else {
            return $this->insertar(); 
        }
    }

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
