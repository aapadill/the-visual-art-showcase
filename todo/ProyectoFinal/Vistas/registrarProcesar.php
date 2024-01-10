<?php
include '../config/cargador.php';

use Controladores\Router;
use Modelos\Usuario;

if (Router::esGet()) {
    Router::redireccionar('registrar.php');
}
