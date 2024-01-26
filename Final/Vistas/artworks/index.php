<?php
//ob_start(); //buffering trick
require_once('../../config/cargador.php');
use Controladores\Router;

include Router::direccion('/plantillas/header.php');

?>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h1>Oh @<?php echo $nombreSesion;?>!</h1>
            <p class="lead">You'll have the ability to manage all your artworks right here, but it's not quite ready yet. <br> Please check back soon for updates! 🖼️ </p>
            <a href="<?php Router::direccionWeb("index.php")?>" class="btn btn-primary">If you say so...</a>
        </div>
    </div>
</div>

<?php
include Router::direccion('/plantillas/footer.php');
?>