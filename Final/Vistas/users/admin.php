<?php
require_once('../../config/cargador.php');
use Controladores\Router;
use Modelos\Usuario;
include Router::direccion('/plantillas/header.php');

if(empty($usuarioSesion) || $rolSesion == 1 || $rolSesion == 2){
    Router::direccionWeb('login.php');
}

if($rolSesion == 3){
    $resultados = Usuario::listar();
}

//Listado Usuarios
var_dump($resultados);
?>

<?php
include Router::direccion('/plantillas/footer.php');
?>
