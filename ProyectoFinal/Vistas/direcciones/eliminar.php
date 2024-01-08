<?php
include '../../config/cargador.php';
use Controladores\Router;
use Modelos\Direccion;

//echo debug
echo '<pre>';
echo '$_POST: ';
var_dump($_POST);

$direccion = $_POST; //arreglo

$direccionOBJ = new Direccion($direccion); //objeto
//debug
echo '$direccionOBJ: ';
var_dump($direccionOBJ); //objeto

$existeEnOrden = 0; //aqui se revisa si existe direccion_id en todas las ordenes

if (Router::esGet()){
    Router::redireccionar('direcciones/index.php');
}

//click en eliminar
if (!$existeEnOrden) {
    //7.a.ii.1) borra direccion, tal vez seria bueno preguntar antes de ejecutar
    $eliminado = $direccionOBJ->borrar();
  
    //debug
    echo 'insercionSQL: ';
    var_dump($eliminado);
    
    Router::redireccionar('direcciones/index.php');
}
  