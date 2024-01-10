<?php
require_once('../config/cargador.php');
use Modelos\Producto;
use Controladores\Router;

$productos = Producto::buscar();

include Router::direccion('/plantillas/header.php');

?>
<div class="row row-cols-md-3" id="productos">
  <?php
    foreach ($productos as $producto) {
      var_dump($producto);
  ?>
  <div class="col">
    <div class="card">
      <img src="/ProyectoFinal/img/productos/producto.png" class="card-img-top" alt="producto">
      <div class="card-body" id="producto-1">
        <h5 class="card-title"><span>$99.99</span>Mobydick</h5>
        <p class="card-text">Mobydick</p>
        <form action="/ProyectoFinal/Vistas/carritoCompra/agregar.php" class="agregar form-inline" method="POST">
          <div class="input-group">
            <input type="hidden" name="producto_id" value="1">
            <input type="hidden" name="precio_final" value="99.99">
            <input type="number" class="form-control" value="0" min="1" max="10" name="cantidad">
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

  <div class="col">
    <div class="card">
      <img src="/ProyectoFinal/img/productos/producto.png" class="card-img-top" alt="producto">
      <div class="card-body" id="producto-1">
        <h5 class="card-title"><span>$299.99</span>Red</h5>
        <p class="card-text">KC Test</p>
        <form action="/ProyectoFinal/Vistas/carritoCompra/agregar.php" class="agregar form-inline" method="POST">
          <div class="input-group">
            <input type="hidden" name="producto_id" value="2">
            <input type="hidden" name="precio_final" value="299.99">
            <input type="number" class="form-control" value="0" min="1" max="10" name="cantidad">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Agregar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img src="/ProyectoFinal/img/productos/producto.png" class="card-img-top" alt="producto">
      <div class="card-body" id="producto-1">
        <h5 class="card-title"><span>$300</span>StarWars</h5>
        <p class="card-text">Pelicula Test</p>
        <form action="/ProyectoFinal/Vistas/carritoCompra/agregar.php" class="agregar form-inline" method="POST">
          <div class="input-group">
            <input type="hidden" name="producto_id" value="3">
            <input type="hidden" name="precio_final" value="300">
            <input type="number" class="form-control" value="0" min="1" max="10" name="cantidad">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Agregar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<?php
include Router::direccion('/plantillas/footer.php');