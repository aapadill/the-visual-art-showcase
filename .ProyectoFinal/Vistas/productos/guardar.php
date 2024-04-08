<?php
include '../../config/cargador.php';
use Controladores\Router;
use Modelos\Producto;

//echo debug
echo '<pre>';
echo '$_POST: ';
var_dump($_POST);

$producto = $_POST; //arreglo

$algunCampoVacio = empty($producto['producto_id']) || empty($producto['nombre']) || empty($producto['descripcion']) || empty($producto['precio']) || empty($producto['vendedor_id']); //|| empty($producto['img_producto'])

$productoOBJ = new Producto($producto); //objeto
//debug
echo '$productoOBJ: ';
var_dump($productoOBJ); //objeto

$existeProducto = $productoOBJ->existe($producto['producto_id']);
$existeNombreProducto = 0; //permitimos el duplicado de nombre de productos por usuario, posible cambio despues

//$productoNuevo = ($producto['producto_id']=="n") ? 1 : 0;

if (Router::esGet() || $algunCampoVacio || !$existeProducto){
    echo '$algunCampoVacio: ';
    var_dump($algunCampoVacio);
    echo '$existeProducto: ';
    var_dump($existeProducto);
    Router::redireccionar('productos/index.php');
}

//click en editar
if (!$algunCampoVacio) { 
    //7.b.c) edita o registra un producto
    if (!$existeNombreProducto){
        $insertado = $productoOBJ->guardar(); //podrias pasar existeDireccion como param
    }
    if ($existeNombreProducto){
        //mensaje de sobreescritura
        $insertado = $productoOBJ->guardar(); //podrias pasar existeNombreDireccion como param
    }

    //debug
    echo 'insercionSQL: ';
    var_dump($insertado);

    Router::redireccionar('productos/index.php');
}