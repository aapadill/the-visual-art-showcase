<?php
namespace Controllers;

class Router {
    public static function redirectTo($route){
        header('Location: ' . PROJECT_PATH . "/Views/$route");
    }

    public static function whichMethod(){
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    public static function isPost() {
        return self::whichMethod() == 'POST';
    }

    public static function isGet() {
        return !self::isPost();
    }

    //page  //aka direccion
    public static function bringPage($route) { 
        return COMPLETE_PROJECT_PATH . "/Views/$route";
    }

    //page path     //aka direccion web
    public static function printPagePath($route) { 
        echo PROJECT_PATH . "/Views/$route";
    }

    //image      //aka rutaImagen
    public static function bringImage($image){ 
        return COMPLETE_PROJECT_PATH . "/images/$image";
    }

    //image path    //aka rutaImagenWeb
    public static function printImagePath($image) { 
        echo PROJECT_PATH . "/images/$image";
    }

    //file path     //aka rutaRecursoWeb
    public static function printFilePath($file) {
        echo PROJECT_PATH . "/resources/$file";
    }
}