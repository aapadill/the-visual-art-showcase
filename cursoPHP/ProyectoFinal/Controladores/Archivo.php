<?php
namespace Controladores;

class Archivo {
    /**
     * Guarda la imagen cargada por el ususario
     * en la ruta $rutaBase con el nombre 
     * $imagenNombre
     *
     * @param $imagen Arreglo con los datos de la imagen cargada
     * @param $rutaBase Ruta donde se guardara la imagen
     * @param $imagenNombre nombre opcional que se le dara al archivo cargado
     *
     * @return boolean|string del archivo cargado si se realizo correctamente la carga
     */
    public static function cargarImagen($imagen, $rutaBase, $imagenNombre = '') {
        $archivoCargado = false;
    
        $nombreImagen = $imagen['name'];
        if (!empty($imagenNombre)) {
            $nombreImagen = "$imagenNombre." .  substr($nombreImagen, strlen($nombreImagen ) - 3 , strlen($nombreImagen));
        }
        $rutaFinal = "$rutaBase/$nombreImagen";
        if (is_uploaded_file($imagen['tmp_name'])) {
            move_uploaded_file($imagen['tmp_name'], $rutaFinal);
            $archivoCargado = $rutaFinal;
        }
    
        return $archivoCargado;
    }
}