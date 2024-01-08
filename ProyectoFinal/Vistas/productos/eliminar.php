<?php
include '../../config/cargador.php';
use Controladores\Router;
use Modelos\Producto;

//echo debug
echo '<pre>';
echo '$_POST: ';
var_dump($_POST);

$producto = $_POST; //arreglo

$productoOBJ = new Producto($producto); //objeto
//debug
echo '$productoOBJ: ';
var_dump($productoOBJ); //objeto

$existeEnOrden = 0; //aqui se revisa si existe direccion_id en todas las ordenes

if (Router::esGet()){
    Router::redireccionar('productos/index.php');
}

//click en eliminar
if (!$existeEnOrden) {
    //7.a.ii.1) borra producto, tal vez seria bueno preguntar antes de ejecutar
    $eliminado = $productoOBJ->borrar();
  
    //debug
    echo 'insercionSQL: ';
    var_dump($eliminado);
    
    Router::redireccionar('productos/index.php');
}
  