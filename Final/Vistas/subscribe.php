<?php
ob_start(); //buffering trick
require_once('../config/cargador.php');
use Controladores\Router;
use Modelos\Usuario;

include('./plantillas/header.php');

if(empty($usuarioSesion)){
    //$sesion->insertar('fromSubscribe', 1); //you got a position ticket
    echo "else raro 4";
    Router::redireccionar('login.php');
}

$registro = $_POST;
if (Router::esPost() && !$usuarioSesion->isSubscribed) {
    $checkboxChecked = isset($registro['is_subscribed']) ? $registro['is_subscribed'] : false;

    if ($checkboxChecked) {
        $usuarioOBJ = Usuario::consultar($usuarioIdSesion);
        if ($usuarioOBJ && !$usuarioOBJ->isSubscribed) {
            $usuarioOBJ->isSubscribed = 1; //set subscribed to true in obj
            $usuarioOBJ->actualizarSuscripcion(); //update subscription status in DB
            $sesion->insertar('welcomeValid2', 1); //you got a welcome ticket
            $usuarioSesion->isSubscribed = 1; //update current session
            echo "sub done, the triggering redirect in 3,2,1";
            Router::redireccionar('welcome-subscription.php');
        }
    }
}
// echo "todavia no envia el formulario de subscribir";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h1>Subscribe! </h1>
            <p class="lead">Subscribe to get the latest artworks, news, and updates from our artists.</p>
            
            <form action="" method="post">
            <div class="d-flex justify-content-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="termsCheck" name="is_subscribed" value=1 required>
                    <label class="form-check-label" for="termsCheck">I agree to the <a href="#">terms and conditions</a>.</label>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
include('./plantillas/footer.php');
?>