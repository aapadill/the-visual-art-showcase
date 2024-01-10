<?php
//Estas van en un archivo de constantes
define("RUTA_BASE_WEB", '/cursoPHP/ProyectoFinal2'); //cambiar si necesario
define("RUTA_BASE", $_SERVER['DOCUMENT_ROOT'] . RUTA_BASE_WEB);

spl_autoload_register('cargador');


function cargador($clase) {
    //echo "Intenta incluir la clase: {$clase}<br/>";
    $RUTA = RUTA_BASE . RUTA_BASE_WEB;
    $EXTENSION = ".php";
    $clase = str_replace('\\', DIRECTORY_SEPARATOR, $clase);
    $clase = str_replace('/', DIRECTORY_SEPARATOR, $clase);

    $rutaArchivo = "{$RUTA}{$clase}{$EXTENSION}";
    if (file_exists($rutaArchivo)) {
        require_once($rutaArchivo);
        return;
    }

    $rutaArchivo = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "{$clase}{$EXTENSION}";
    if (file_exists($rutaArchivo)) {
        require_once($rutaArchivo);
        return;
    }
    
    $rutaArchivo = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "{$clase}{$EXTENSION}";
    if (file_exists($rutaArchivo)) {
        require_once("{$RUTA}{$clase}{$EXTENSION}");
        return;
    }

    echo $clase;
}
?>