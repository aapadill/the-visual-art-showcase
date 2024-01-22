<?php
namespace Modelos; //belongs to Modelos
//require_once('../config/cargador.php'); //Comentar para usar en las vistas
use Modelos\Conexion;

class WeeklyShowcase {

    public $weeklyShowcaseID;
    public $weekStartDate;
    public $weekEndDate;
    public $featuredArtistID;
    
    public function __construct($week = []) {
        $this->weeklyShowcaseID = $week['weekly_showcase_id'] ?? null;
        $this->weekStartDate = $this->convertToDate($week['week_start_date'] ?? '');
        $this->weekEndDate = $this->convertToDate($week['week_end_date'] ?? '');
        $this->featuredArtistID = $week['featured_artist_id'] ?? null;
    }

    public static function convertToDate($dateString) {
        return $dateString ? date('Y-m-d', strtotime($dateString)) : null;
    }

    public static function consultar($weeklyShowcaseID) {
        $sql = "
            SELECT *
            FROM
                WeeklyShowcase
            WHERE
            weekly_showcase_id = :weekly_showcase_id
        ";
        $parametros = [
            'weekly_showcase_id' => $weeklyShowcaseID
        ];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        $weekData = $resultados->fetch();
        return new WeeklyShowcase($weekData);
    }
    
    public static function whichID($date) {
        $sql = "
            SELECT weekly_showcase_id
            FROM WeeklyShowcase
            WHERE :date BETWEEN week_start_date AND week_end_date
        ";
        $parametros = ['date' => $date];

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        $weekData = $resultados->fetch();
        return $weekData ? $weekData['weekly_showcase_id'] : null;
    }
}   

    // public static function buscar($busqueda = '') {
        //     $sql = "
        //     SELECT 
        //         A.artist_id, A.user_id, A.artist_name, A.bio, A.website, A.social_media, 
        //         AW.artwork_id, AW.title, AW.technical_sheet, AW.image_url, AW.upload_date, AW.category_id,
        //         C.category_name
        //     FROM
        //         Artists A
        //     LEFT JOIN Artworks AW ON A.artist_id = AW.artist_id
        //     LEFT JOIN Category C ON AW.category_id = C.category_id
        //     WHERE
        //         1 = 1
        //     ";
        //     $parametros = [];
        
        //     if (!empty($busqueda)) {
        //         $sql .= " AND (LOWER(A.artist_name) LIKE CONCAT('%', LOWER(:busqueda), '%') 
        //                  OR LOWER(AW.title) LIKE CONCAT('%', LOWER(:busqueda), '%')
        //                  OR LOWER(C.category_name) LIKE CONCAT('%', LOWER(:busqueda), '%'))";
        //         $parametros['busqueda'] = $busqueda;
        //     }
        
        //     $conexion = new Conexion();
        //     $resultados = $conexion->correrQuery($sql, $parametros);
        //     return $resultados;
        // }

    // public static function existe($productoId) {
    //     $sql = "
    //         SELECT 1
    //         FROM
    //             productos P
    //         WHERE
    //             P.producto_id = :productoId
    //     ";
    //     $parametros = [
    //         'productoId' => $productoId
    //     ];
    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);
    //     $numproductos = $resultados->rowCount();
    //     return 0 < $numproductos;
    // }

    //public static function buscar($busqueda = '') {
    //     $sql = "
    //     SELECT P.producto_id, P.nombre, P.descripcion, P.precio, P.img_producto
    //     FROM
    //         productos P
    //     WHERE
    //         1 = 1
    //     ";
    //     $parametros = [];

    //     if (!empty($busqueda)) {
    //         $sql .= " AND (lower(nombre) LIKE CONCAT('%', lower(:busqueda),  '%')  OR lower(descripcion) LIKE CONCAT('%', lower(:busqueda),  '%'))";
    //         $parametros['busqueda'] = $busqueda;
    //     }
    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);
    //     return $resultados;
    //}

    // public static function listar($vendedorId = 0) {
    //     $sql = "
    //         SELECT P.*, U.nombre_usuario
    //         FROM
    //             productos P
    //         JOIN usuarios U ON P.vendedor_id = U.usuario_id
    //         WHERE
    //             1 = 1
    //         AND (:vendedorId = 0 OR P.vendedor_id = :vendedorId)
    //     ";
    
    //     $parametros = [
    //         ':vendedorId' => $vendedorId
    //     ];
    
    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);
    
    //     return $resultados;
    // }

    // public static function total($ordenId) {
    //     $sql = "
    //         SELECT SUM(precio_final * cantidad) as total
    //         FROM
    //             orden_producto
    //         WHERE
    //             orden_id = :ordenId
    //     ";

    //     $parametros = [
    //         ':ordenId' => $ordenId
    //     ];

    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);

    //     $totalCompra = $resultados->fetchColumn();
    //     return $totalCompra;
    // }

    // private function insertar(){
    //     $sql = "
    //         INSERT INTO productos (nombre, descripcion, precio, img_producto, vendedor_id)
    //         VALUES (:nombre, :descripcion, :precio, :imgProducto, :vendedorId)
    //     ";
        
    //     $parametros = [
    //         ':nombre' => $this->nombre,
    //         ':descripcion' => $this->descripcion,
    //         ':precio' => $this->precio,
    //         ':imgProducto' => $this->imgProducto,
    //         ':vendedorId' => $this->vendedorId,
    //     ];

    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);

    //     // Obtener el ID insertado y asignarlo a la propiedad $this->productoId
    //     $this->productoId = $conexion->lastInsertId();
    //     return $resultados;
    // }

    // private function actualizar() {
    //     $sql = "
    //         UPDATE productos
    //         SET
    //             nombre = :nombre,
    //             descripcion = :descripcion,
    //             precio = :precio,
    //             img_producto = :imgProducto,
    //             vendedor_id = :vendedorId
    //         WHERE
    //             producto_id = :productoId
    //     ";
        
    //     $parametros = [
    //         ':productoId' => $this->productoId,
    //         ':nombre' => $this->nombre,
    //         ':descripcion' => $this->descripcion,
    //         ':precio' => $this->precio,
    //         ':imgProducto' => $this->imgProducto,
    //         ':vendedorId' => $this->vendedorId,
    //     ];

    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);
    //     return $resultados;
    // }

    // public function guardar() {
    //     if (self::existe($this->productoId)) {
    //         return $this->actualizar();
    //     } else {
    //         return $this->insertar(); 
    //     }
    // }

    // public function borrar() {
    //     $sql = "
    //         DELETE FROM
    //             productos
    //         WHERE
    //             producto_id = :productoId
    //     ";

    //     $parametros = [
    //         ':productoId' => $this->productoId,
    //     ];

    //     $conexion = new Conexion();
    //     $resultados = $conexion->correrQuery($sql, $parametros);
    //     return $resultados;
    // }

//     public function actualizarPrecio($precio) {
//         $sql = "
//             UPDATE
//                 productos
//             SET
//                 precio = :precio
//             WHERE
//                 producto_id = :productoId
//         ";

//         $parametros = [
//             ':precio' => $precio,
//             ':productoId' => $this->productoId,
//         ];

//         $conexion = new Conexion();
//         $resultados = $conexion->correrQuery($sql, $parametros);
//         return $resultados;
//     }
