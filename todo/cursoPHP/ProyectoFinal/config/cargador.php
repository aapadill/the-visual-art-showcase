<?php
//Estas van en un archivo de constantes
define("RUTA_BASE_WEB", '/ProyectoFinal');
define("RUTA_BASE", $_SERVER['DOCUMENT_ROOT'] . RUTA_BASE_WEB);

spl_autoload_register('cargador');

function cargador($clase) {
    //echo "Intenta incluir la clase: {$clase}<br/>";
    $RUTA = RUTA_BASE . '/';
    $EXTENSION = ".php";
    $clase = str_replace('\\', '/', $clase);
    require_once("{$RUTA}{$clase}{$EXTENSION}");
}
?>