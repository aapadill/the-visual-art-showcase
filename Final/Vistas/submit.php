<?php
// ob_start(); //buffering trick
require_once('../config/cargador.php');
use Controladores\Router;

include('./plantillas/header.php');

if(empty($usuarioIdSesion)){
    Router::redireccionar('login.php');
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h1>About that...</h1>
            <p class="lead">Currently, we're not accepting submissions, but feel free to subscribe, and we'll let you know as soon as they open up again. <br> Thanks for your interest @<?php echo $nombreSesion;?>! 📩</p>
            <a href="<?php Router::direccionWeb("index.php")?>" class="btn btn-primary">Take me home</a>
        </div>
    </div>
</div>

<?php
include('./plantillas/footer.php');
?>