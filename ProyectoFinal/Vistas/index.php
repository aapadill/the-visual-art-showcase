<?php
require_once('../config/cargador.php');
use Modelos\Producto;
use Controladores\Router; 
// use Controladores\Sesion;

include Router::direccion('/plantillas/header.php');

$busqueda = htmlentities($_GET['buscar'] ?? ''); //3.b.ii) texto a buscar
$productos = Producto::buscar($busqueda); //3.b.i) regresa coincidencia

// $sesion = new Sesion();
$productosSesion = $sesion->obtener('productos') ?? []; //cualquier producto en sesion

//aqui andaba el Router::direccion
?>

<div class="row row-cols-md-3" id="productos">
  <!-- for para la coincidencia, por default se muestran todos los productos -->
  <?php
    foreach($productos as $producto) {
      $nuevaCantidad = htmlentities($productosSesion[$producto['producto_id']]['cantidad'] ?? '0');
  ?>
    <!-- n producto -->
    <div class="col">
      <div class="card">
        <!-- imagen -->
        <img src="<?php Router::rutaImagenWeb($producto['img_producto'])?>" class="card-img-top" alt="...">
        <!-- info -->
        <div class="card-body" id="producto-1">
          <!-- precio + nombre -->
          <h5 class="card-title">
            <?php echo $producto['nombre'];?>
            <br>
            <span>
              $<?php echo $producto['precio']; ?>
            </span>
          </h5>
          <!-- descripcion -->
          <p class="card-text"><?php echo $producto['descripcion']; ?></p>
          
          <!-- cada producto tiene un formulario POST, 4.a.i) agregar.php -->
          <form action="./carritoCompra/agregar.php" class="agregar form-inline" method="POST">
            <div class="input-group">
              <!-- 4.b.iii) elementos del POST -->
              <input type="hidden" name="producto_id" value="<?php echo $producto['producto_id']; ?>">
              <input type="hidden" name="nombre" value="<?php echo $producto['nombre']; ?>"> <!-- nombre -->
              <input type="hidden" name="imagen" value="<?php Router::rutaImagenWeb($producto['img_producto']) ?>"> <!-- imagen -->
              <input type="hidden" name="precio_final" value="<?php echo $producto['precio']; ?>">
              <input type="number" class="form-control" value="<?php echo $nuevaCantidad; ?>" min="0" max="10" name="cantidad">
              <!-- boton -->
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