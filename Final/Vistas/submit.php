<?php
// ob_start(); //buffering trick
require_once('../config/cargador.php');
use Controladores\Router;

include Router::direccion('/plantillas/header.php');

if(empty($usuarioIdSesion)){
    Router::redireccionar('login.php');
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h1>About that...</h1>
            <p class="lead">Sorry @<?php echo $nombreSesion;?> we're still working on it, but please try again soon</p>
            <a href="<?php Router::direccionWeb("index.php")?>" class="btn btn-primary">Take me home</a>
        </div>
    </div>
</div>

<?php
include Router::direccion('/plantillas/footer.php');
?>