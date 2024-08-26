<?php
ob_start(); //buffering trick
include '../../config/cargador.php';
use Controladores\Router;
use Modelos\Usuario;

if (Router::esGet()) {
  Router::redireccionar('index.php');
}

include('../plantillas/header.php');

//Procesar Editar
//!empty($_POST['user_id']) && !empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])
if (Router::esPost()) {
    $usuario = $_POST;
    $current = Usuario::consultar($usuario['user_id']);
    if (empty($_FILES['profile_picture']['name'])) {
      $usuario['profile_picture'] = RUTA_BASE_WEB . "/images/users/" . $_FILES['profile_picture']['name'];
    }
    if (Usuario::checkUsernameOrEmail($usuario['username'], $usuario['email'], $current->userID) === 1) {
        $usuario = new Usuario($usuario);
        $correcto = $usuario->actualizar();
        $sesion->insertar('usuario', $usuario);
        Router::redireccionar('users/index.php');
        // var_dump($_POST);
    } else {
        $error = urlencode('Username or email already in use'); //or Usuario::checkUsernameOrEmail($usuario['username'], $usuario['email'], $current->userID)
        Router::redireccionar('users/edit.php?error=' . $error);
        // var_dump("error else");
    }
    // var_dump("no se inserto, ya esta en uso correo o usuario");
}
// $error = urlencode('Existen campos necesarios en blanco, por favor llenelos');
// Router::redireccionar('users/edit.php?error=' . $error);
?>

<?php
include('../plantillas/footer.php');
?>