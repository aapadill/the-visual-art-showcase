<?php
require_once('../config/cargador.php');
use Controladores\Router;

include Router::direccion('/plantillas/header.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h1>Subscribe! </h1>
            <p class="lead">Subscribe to get the latest artworks, news, and updates from our artists.</p>
            
            <form action="path/to/your/form/handler" method="post">
            <div class="d-flex justify-content-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="termsCheck" required>
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
// include your footer file
include Router::direccion('/plantillas/footer.php');
?>