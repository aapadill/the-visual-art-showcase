<?php
include '../../config/cargador.php';
use Controladores\Router;
use Controladores\Sesion;

if (Router::esGet()) { //si es GET, redirije a index
  Router::redireccionar('index.php');
}

$sesion = new Sesion();

//obtenemos producto_id del POST
$productoId = htmlspecialchars($_POST['producto_id'] ?? '');

//obtenemos cantidad del POST
$cantidad = htmlspecialchars($_POST['cantidad'] ?? '');

//si productoId no esta vacio
if (!empty($productoId)) {
  $producto = $_POST; //se copia $POST a $producto
  $sesion->insertarProducto($productoId, $producto, $cantidad); //4.a.ii) y 4.a.iii)
}

//echo debug
echo '<pre>';
echo '$_POST: ';
var_dump($_POST);

echo 'productoID: ';
var_dump($productoId);

echo '$_SESSION: ';
var_dump($_SESSION);

Router::redireccionar('index.php'); //proceso terminado, amonos