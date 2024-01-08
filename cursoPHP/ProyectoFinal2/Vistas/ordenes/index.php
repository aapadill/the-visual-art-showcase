<?php
include_once '../../config/cargador.php';

use Controladores\Router;

include Router::direccion('plantillas/header.php');
?>
  <h4>Administrar Ordenes</h4>
  <br>
  <br>
  <table class="table table-hover">
    <thead class="table-dark">
      <tr>
        <th>Id</th>
        <th>Comprador</th>
        <th>Direccion</th>
        <th>Status</th>
        <th>Total</th>
        <th>Ver Productos</th>
        <th>Enviar</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Id</td>
        <td>comprador</td>
        <td>direccion</td>
        <td>Status</td>
        <td>$25.5</td>
        <th><a href="verProductos.php" class="btn btn-primary">Ver Productos</a></th>
        <td><form action="eliminar.php" method="POST" class="form">
          <input type="hidden" name="orden_id" value="">
          <input type="submit" value="Enviar" class="btn btn-success">
        </form></td>
      </tr>
    </tbody>
  </table>
<?php
include Router::direccion('plantillas/footer.php');