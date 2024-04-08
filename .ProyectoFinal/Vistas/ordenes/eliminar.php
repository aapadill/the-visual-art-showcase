<?php
include '../../config/cargador.php';
use Controladores\Router;
use Modelos\Orden;


if (Router::esGet()){
    Router::redireccionar('ordenes/index.php');
}

if (Router::esPost() && !empty($_POST)) {
    $post = $_POST;
    $objeto = new Orden($post);

    //7.a.ii.1) borra producto, tal vez seria bueno preguntar antes de ejecutar
    $eliminado = $objeto->borrar();
  
    //debug
    echo 'insercionSQL: ';
    var_dump($eliminado);
    
    Router::redireccionar('ordenes/index.php');
}
  