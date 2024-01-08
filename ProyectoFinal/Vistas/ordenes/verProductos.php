<?php
require_once('../../config/cargador.php');

use Controladores\Router;
use Modelos\Orden;

include Router::direccion('plantillas/header.php');

$total = (Router::esGet() && !empty($_GET)) ? Orden::getTotalByOrden($_GET['orden_id']) : 0;
$orden = (Router::esGet() && !empty($_GET)) ? Orden::verProducto($_GET['orden_id']) : '';

?>
<h4>Productos de la Orden</h4>
<br>
<h4>Compra Total: <b> $<?php echo $total?> </b></h4>
<br>

<table class="table table-hover">
  <thead class="table-dark">
    <tr>
      <th>OrdenID</th>
      <th>ProductoID</th>
      <th>Cantidad</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Precio al ordenar</th>
    </tr>
  </thead>

  <?php
    foreach ($orden as $producto){
  ?>
  <tbody>
      <tr>        
        <td><?php echo $producto['orden_id'];?></td>
        <td><?php echo $producto['producto_id'];?></td>
        <td><?php echo $producto['cantidad'];?></td>
        <td><?php echo $producto['nombre'];?></td>
        <td><?php echo $producto['descripcion'];?></td>
        <td><?php echo $producto['precio_final_orden'];?></td>
      </tr>
  </tbody>
  <?php
  }
  ?>
</table>
<br>
<a href="index.php" class="btn btn-primary">Regresar</a>
<?php
include Router::direccion('plantillas/footer.php');
?>