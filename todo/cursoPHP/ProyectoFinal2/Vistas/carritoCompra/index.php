<?php
require_once('../../config/cargador.php');

use Controladores\Router;
use Controladores\Sesion;

$sesion = new Sesion();
$productosSesion = $sesion->obtener('productos') ?? [];

include Router::direccion('/plantillas/header.php');
include Router::direccion('/carritoCompra/verCarrito.php');
include Router::direccion('/plantillas/footer.php');
?>