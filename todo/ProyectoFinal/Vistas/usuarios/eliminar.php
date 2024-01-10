<?php
include '../../config/cargador.php';
use Controladores\Router;
use Modelos\Usuario;

if (Router::esGet()) {
    Router::redireccionar('usuarios/index.php');
}

// Procesar borrado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST;
    $usuario = new Usuario($id);
    $usuario->borrar();
    Router::redireccionar('usuarios/index.php');
}