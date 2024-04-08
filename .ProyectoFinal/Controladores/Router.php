<?php
namespace Controladores;

class Router {
    /**
     * Redirecciona en base a la ruta Web
     */
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

    /**
     * Regresa la ruta para incluir
     * 
     * 
     * @param $ruta de la vista que se necesita presentar
     * @return string ruta absoluta en el servidor
     */
    public static function direccion($ruta) {
        return RUTA_BASE . "/Vistas/$ruta";
    }

    /**
     * Regresa la ruta para crear un hipervinculo
     * 
     * 
     * @param $ruta de la vista que se necesita presentar
     */
    public static function direccionWeb($ruta) {
        echo RUTA_BASE_WEB . "/Vistas/$ruta";
    }

    /**
     * Regresa la ruta absoluta en el servidor
     * de la imagen
     * 
     * @return string ruta absoluta en el servidor
     */
    public static function rutaImagen($imagen) {
        return RUTA_BASE . "/img/$imagen";
    }

    /**
     * Imprime la ruta de la imagen para ser presentada
     * en una pagina web
     * 
     */
    public static function rutaImagenWeb($imagen) {
        echo RUTA_BASE_WEB . "/img/$imagen";
    }

    /**
     * Imprime la ruta de una recurso en el servidor
     * 
     */
    public static function rutaRecursoWeb($archivo) {
        echo RUTA_BASE_WEB . "/resources/$archivo";
    }
}