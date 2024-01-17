<?php
require_once('../../config/cargador.php');

use Modelos\Orden;
use Controladores\Sesion;
use Controladores\Router;
use Modelos\Usuario;

$sesion = new Sesion();

$usuario = $sesion->obtener('usuario');

if (empty($usuario)){
    
}
