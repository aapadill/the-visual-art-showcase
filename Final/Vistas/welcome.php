<?php
ob_start(); //buffering trick
require_once('../config/cargador.php');
use Controladores\Router;

include Router::direccion('/plantillas/header.php');

$welcomeFlag = $sesion->obtener('welcomeValid') ?? 0;
if(!$welcomeFlag){
    Router::redireccionar('index.php');
}
$sesion->insertar('welcomeValid', 0); //flag is used
?>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h1>Welcome @<?php echo $nombreSesion; ?>!</h1>
            <p class="lead">It's so cool to have you here at <br> The Visual Art Showcase</p>
            <a href="<?php Router::direccionWeb("index.php")?>" class="btn btn-primary">Take me home</a>
        </div>
    </div>
</div>

<?php
include Router::direccion('/plantillas/footer.php');
?>