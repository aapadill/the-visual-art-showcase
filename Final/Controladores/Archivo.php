<?php
namespace Controladores;

class Archivo {
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