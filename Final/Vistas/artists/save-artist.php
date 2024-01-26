<?php
ob_start(); //buffering trick
include '../../config/cargador.php';
use Controladores\Router;
use Modelos\Artist;

if (Router::esGet()) {
  Router::redireccionar('index.php');
}

// var_dump($_POST);
//Procesar Editar
//!empty($_POST['user_id']) && !empty($_POST['artist_name'])
if (Router::esPost()) {
    $artista = $_POST;
    $artista = new Artist($artista);
    $correcto = $artista->actualizar();
    Router::redireccionar('artists/index-artist.php');
}
// $error = urlencode('Existen campos necesarios en blanco, por favor llenelos');
// Router::redireccionar('users/edit.php?error=' . $error);
?>