<?php
namespace Modelos;
use Modelos\Conexion;

class Category {

    public $categoryID;
    public $categoryName;

    public function __construct($categoryData = []) {
        $this->categoryID = $categoryData['category_id'] ?? null;
        $this->categoryName = $categoryData['category_name'] ?? '';
    }

    public static function consultar($categoryID = null) {
        $sql = "SELECT * FROM Category";
        $parametros = [];

        if ($categoryID !== null) {
            $sql .= " WHERE category_id = :category_id";
            $parametros['category_id'] = $categoryID;
        }

        $conexion = new Conexion();
        $resultados = $conexion->correrQuery($sql, $parametros);

        if ($categoryID !== null) {
            return $resultados->fetch();
        } else {
            return $resultados->fetchAll();
        }
    }
}
