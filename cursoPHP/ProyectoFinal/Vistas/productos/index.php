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
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Vendedor</th>
        <th>Precio</th>
        <th>Borrar</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><form action="editar.php" method="GET" class="form">
          <input type="hidden" name="producto_id" value="">
          <input type="submit" value="Editar" class="btn btn-primary">
        </form></td>
        <td>Id</td>
        <td><img width="60px" src="<?php Router::rutaImagenWeb('productos/producto.png');?>" alt="Img"></td>
        <td>Nombre</td>
        <td>Vendedor</td>
        <td>
        <form class="form-inline">
          <div class="form-group mx-sm-3 mb-2">
            <input type="number" class="form-control" value="255">
          
          <button type="submit" class="btn btn-primary mb-2">Actualizar</button>
          </div>
    
        </td>
        <td><form action="eliminar.php" method="POST" class="form">
          <input type="hidden" name="producto_id" value="">
          <input type="submit" value="Eliminar" class="btn btn-danger">
        </form></td>
      </tr>
    </tbody>
  </table>
<?php
include Router::direccion('plantillas/footer.php');