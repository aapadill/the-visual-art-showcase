<?php
require_once('../config/cargador.php');
use Controladores\Sesion;

$sesion = new Sesion();
$sesion->cerrarSesion(); //el sesion destroy esta borrando mi carrito por la eternidad, es posible salvarlo en la sesion iniciada?
?>