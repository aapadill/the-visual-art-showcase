<?php
require_once('../../config/cargador.php');

use Modelos\Orden;
use Controladores\Sesion;
use Controladores\Router;
use Modelos\Usuario;

$sesion = new Sesion();

$usuario = $sesion->obtener('usuario');

if (empty($usuario)) {
    Router::redireccionar('login.php');
}


$comprador = $usuario->usuarioId;
$direccion = $_POST['direccion_id'] ?? '';

if (empty($direccion)) {
    Router::redireccionar('carritoCompra/index.php');
}

$productosOrden = $sesion->obtener('productos') ?? [];

if (empty($productosOrden)) {        
    include Router::direccion('/plantillas/header.php');
    include Router::direccion('/carritoCompra/carritoVacio.php');
    include Router::direccion('/plantillas/footer.php');
    exit;
}


$ordenArr = [
    'comprador_id' => $comprador,
    'direccion_id' => $direccion
];

$orden = new Orden($ordenArr, $productosOrden);
$orden->insertar();
unset($_SESSION['productos']);

Router::redireccionar('index.php');

