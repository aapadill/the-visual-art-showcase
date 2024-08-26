<?php
//ob_start(); //buffering trick
require_once('../config/cargador.php');
use Controladores\Router;

include('./plantillas/header.php');

?>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h1>Hey @<?php echo $nombreSesion;?>!</h1>
            <p class="lead">You will soon be able to manage all your favorites right here at The Visual Art Showcase. <br> 🎨 Stay tuned for updates!</p>
            <a href="<?php Router::direccionWeb("index.php")?>" class="btn btn-primary">If you say so...</a>
        </div>
    </div>
</div>

<?php
include('./plantillas/footer.php');
?>