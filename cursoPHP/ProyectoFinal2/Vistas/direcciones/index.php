<?php
include_once '../../config/cargador.php';

use Controladores\Router;

include Router::direccion('plantillas/header.php');
?>
    <h4>Administrar Direcciones</h4>
    <a href="editar.php" class="btn btn-info">Agregar dirección</a>
  <br>
  <br>
  <table class="table table-hover">
    <thead class="table-dark">
      <tr>
        <th>Editar</th>
        <th>Id</th>
        <th>Nombre</th>
        <th>Calle Numero</th>
        <th>Cp</th>
        <th>Colonia</th>
        <th>Municipio</th>
        <th>Estado</th>
        <th>Borrar</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><form action="editar.php" method="GET" class="form">
          <input type="hidden" name="direccion_id" value="">
          <input type="submit" value="Editar" class="btn btn-primary">
        </form></td>
        <td>Id</td>
        <td>Nombre</td>
        <td>Calle Numero</td>
        <td>Cp</td>
        <td>Colonia</td>
        <td>Municipio</td>
        <td>Estado</td>
        <td><form action="eliminar.php" method="POST" class="form">
          <input type="hidden" name="direccion_id" value="">
          <input type="submit" value="Eliminar" class="btn btn-danger">
        </form></td>
      </tr>
    </tbody>
  </table>
<?php
include Router::direccion('plantillas/footer.php');