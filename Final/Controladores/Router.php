<?php
namespace Controladores;

class Router {
    public static function redireccionar($ruta) {
        header('Location: ' . RUTA_BASE_WEB . "/Vistas/$ruta");
    }

    public static function metodo() {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    public static function esPost() {
        return self::metodo() == 'POST';
    }

    public static function esGet() {
        return !self::esPost();
    }

    //completa
    public static function direccion($ruta) {
        return RUTA_BASE . "/Vistas/$ruta";
    }

    //ruta basica
    public static function direccionWeb($ruta) {
        echo RUTA_BASE_WEB . "/Vistas/$ruta";
    }

    //completa
    public static function rutaImagen($imagen) {
        return RUTA_BASE . "/img/$imagen";
    }

    //ruta basica
    public static function rutaImagenWeb($imagen) {
        echo RUTA_BASE_WEB . "/$imagen";
    }

    //ruta basica
    public static function rutaRecursoWeb($archivo) {
        echo RUTA_BASE_WEB . "/resources/$archivo";
    }

    //ruta basica
    public static function rutaWebStatic($archivo) {
        echo RUTA_BASE_WEB . "/static/$archivo";
    }
}