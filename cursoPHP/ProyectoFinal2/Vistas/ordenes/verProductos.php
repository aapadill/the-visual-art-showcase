<?php
require_once('../../config/cargador.php');
use Controladores\Router;


include Router::direccion('plantillas/header.php');
?>
<h4>Productos de la Orden</h4>
<br>
<h4>Compra Total : <b>$500</b></h4>
<br>

<table class="table table-hover">
  <thead class="table-dark">
    <tr>
      <th>Id</th>
      <th>Cantidad</th>
      <th>Precio</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
      <tr>        
        <td>Id</td>
        <td>1</td>
        <td>$5</td>
        <td>$5</td>
      </tr>
  </tbody>
</table>
<br>
<a href="index.php" class="btn btn-primary">Regresar</a>
<?php
include Router::direccion('plantillas/footer.php');
?>