<?php
include '../../config/cargador.php';
use Controladores\Router;
use Controladores\Sesion;

if (Router::esGet()) {
  Router::redireccionar('index.php');
}

$sesion = new Sesion();
$productoId = htmlspecialchars($_POST['producto_id'] ?? '');

if (!empty($productoId)) {
  $sesion->insertarProducto($productoId, $_POST);
}
var_dump($_POST);
var_dump($productoId);
var_dump($_SESSION);

Router::redireccionar('index.php');
