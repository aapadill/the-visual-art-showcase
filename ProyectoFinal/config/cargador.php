<?php
//Estas van en un archivo de constantes
define("RUTA_BASE_WEB", '/ProyectoFinal'); //ruta a carpeta del proyecto
define("RUTA_BASE", $_SERVER['DOCUMENT_ROOT'] . RUTA_BASE_WEB); //la ruta raiz por default es htdocs, se muestra como ./

spl_autoload_register('cargador');

function cargador($clase) {
    //echo "Intenta incluir la clase: {$clase}<br/>";
    $RUTA = RUTA_BASE . RUTA_BASE_WEB;
    $EXTENSION = ".php";
    //se remplazan los separadores del string a los adecuados
    $clase = str_replace('\\', DIRECTORY_SEPARATOR, $clase);
    $clase = str_replace('/', DIRECTORY_SEPARATOR, $clase);

    //a, b, c, existen para incluir el archivo dinamicamente
    //a) intenta localizar el archivo de la clase en root/ruta_base_web
    $rutaArchivo = "{$RUTA}{$clase}{$EXTENSION}";
    if (file_exists($rutaArchivo)) {
        require_once($rutaArchivo);
        return;
    }

    //b) intenta localizar el archivo de la clase en el directorio padre
    $rutaArchivo = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "{$clase}{$EXTENSION}";
    if (file_exists($rutaArchivo)) {
        require_once($rutaArchivo);
        return;
    }
    
    //c) intenta localizar el archivo de la clase en el directorio abuelo
    $rutaArchivo = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "{$clase}{$EXTENSION}";
    if (file_exists($rutaArchivo)) {
        require_once("{$RUTA}{$clase}{$EXTENSION}");
        return;
    }

    echo $clase;
}
?>