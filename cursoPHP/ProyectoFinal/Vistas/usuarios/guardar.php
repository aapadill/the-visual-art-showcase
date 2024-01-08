<?php
include '../../config/cargador.php';

use Controladores\Router;
use Modelos\Usuario;

if (Router::esGet()) {
    Router::redireccionar('index.php');
}

//Procesar Editar
if (!empty($_POST['nombre'])) {
    $usuario = $_POST;
    if (empty($_FILES['imagen_archivo']['name'])) {
      $usuario['img_usuario'] = RUTA_BASE_WEB . "/img/usuarios/" . $_FILES['imagen_archivo']['name'];
    }
    $usuario = new Usuario($usuario);
    $correcto = $usuario->guardar();
    Router::redireccionar('index.php');
}
