<?php
require_once('../config/cargador.php');
use Modelos\Producto;
use Controladores\Router; 

include Router::direccion('/plantillas/header.php');

$busqueda = htmlentities($_GET['buscar'] ?? ''); //3.b.ii) texto a buscar
// $productos = Producto::buscar($busqueda); //3.b.i) regresa coincidencia

// $productosSesion = $sesion->obtener('productos') ?? []; //cualquier producto en sesion

//aqui andaba el Router::direccion
?>

<div class="row row-cols-md-3" id="productos"> 

</div>

<?php
include Router::direccion('/plantillas/footer.php');