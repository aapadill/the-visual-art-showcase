<?php
ob_start(); //buffering trick
require_once('../config/cargador.php');
use Controladores\Router;

include('./plantillas/header.php');

if(empty($usuarioIdSesion)){
    Router::redireccionar('login.php');
}
$welcomeFlag = $sesion->obtener('welcomeValid2');
if(!$welcomeFlag){
    Router::redireccionar('index.php');
}
$sesion->insertar('welcomeValid2', 0); //flag used
?>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h1>Nice sub @<?php echo $nombreSesion; ?>!</h1>
            <p class="lead">Congratulations, you're at the front of the line for all our exciting updates! 🎉👏 We'll keep you in the loop on everything new and awesome here.</p>
            <a href="<?php Router::direccionWeb("index.php")?>" class="btn btn-primary">Take me home</a>
        </div>
    </div>
</div>

<?php
include('./plantillas/footer.php');
?>