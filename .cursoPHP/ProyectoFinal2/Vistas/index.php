<?php
require_once('../config/cargador.php');
use Modelos\Producto;
use Controladores\Router;
use Controladores\Sesion;

$busqueda = htmlentities($_GET['buscar'] ?? '');
$productos = Producto::buscar($busqueda);

$sesion = new Sesion();
$productosSesion = $sesion->obtener('productos') ?? [];

include Router::direccion('/plantillas/header.php');

?>
<div class="row row-cols-md-3" id="productos">
    
  <?php
    foreach($productos as $producto) {
      $nuevaCantidad = htmlentities($productosSesion[$producto['producto_id']]['cantidad'] ?? '0');
      // echo '<pre>';
      // var_dump($nuevaCantidad);
  ?>
      <div class="col">
        <div class="card">
          <img src="<?php Router::rutaImagenWeb($producto['img_producto'])?>" class="card-img-top" alt="...">
          <div class="card-body" id="producto-1">
            <h5 class="card-title"><span>$<?php echo $producto['precio']; ?></span><?php echo $producto['nombre']; ?></h5>
            <p class="card-text"><?php echo $producto['descripcion']; ?></p>
            <form action="./carritoCompra/agregar.php" class="agregar form-inline" method="POST">
              <div class="input-group">
                <input type="hidden" name="producto_id" value="<?php echo $producto['producto_id']; ?>">
                <input type="hidden" name="precio_final" value="<?php echo $producto['precio']; ?>">
                <input type="number" class="form-control" value="<?php echo $nuevaCantidad; ?>" min="0" max="10" name="cantidad">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">Agregar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  <?php
    }
  ?>

</div>

<?php
include Router::direccion('/plantillas/footer.php');