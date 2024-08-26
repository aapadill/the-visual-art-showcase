<?php
include_once '../../config/cargador.php';

use Controladores\Router;
use Modelos\Producto;

include('../plantillas/header.php');
// debug
// echo '<pre>';
// var_dump($usuarioIdSesion);

$productos = [];

//8.a.i.2) admin
if ($rolSesion == '1'){
  $productos = Producto::listar();
}

//8.a.i.2) vendedor
if ($rolSesion == '2'){
  $productos = Producto::listar($usuarioIdSesion);
}

// debug
// echo '<pre>';
// var_dump($productos);

if (Router::esPost()) {
  $productoActualizado = $_POST;
  $productoID = $productoActualizado['producto_id'];
  $nuevoPrecio = $productoActualizado['precio'];
  $valido = !empty($productoID) && !empty($nuevoPrecio);

  //no vacio
  if ($valido && $nuevoPrecio > 0) {
      //actualizar
      $productoOBJ = new Producto(['producto_id' => $productoID]);
      $productoOBJ->actualizarPrecio($nuevoPrecio);

      //recargar pagina
      Router::redireccionar('productos/index.php');
  } else {
      //error
      echo "algo salio mal";
  }
}

?>
  <div class="container">
    <h4>Administrar Productos</h4>
    <!-- botonAgregar productos -->
      <a href="editar.php" class="btn btn-info">Agregar productos</a>
    <br>
    <br>
    <table class="table table-hover">
      <!-- cabecera tabla -->
      <thead class="table-dark">
        <tr>
          <th>Editar</th>
          <th>ID</th>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Descripcion</th>
          <th>VendedorID</th>
          <th>Vendedor</th>
          <th>Precio</th>
          <th>Borrar</th>
        </tr>
      </thead>
      <!-- productos -->
      <?php
      foreach ($productos as $p) {
      ?>
        <tbody>
          <tr>
            <td>
              <!-- boton Editar -->
              <form action="editar.php" method="GET" class="form">
              <input type="hidden" name="producto_id" value="<?php echo $p['producto_id'];?>">
              <input type="submit" value="Editar" class="btn btn-primary">
              </form>
            </td>
            <td><?php echo $p['producto_id'];?></td>
            <td>
              <img class="img-thumbnail" width="60px" src="<?php Router::rutaImagenWeb($p['img_producto']);?>" alt="Img">
            </td>
            <td><?php echo $p['nombre'];?></td>
            <td><?php echo $p['descripcion'];?></td>
            <td><?php echo $p['vendedor_id'];?></td>
            <td><?php echo $p['nombre_usuario'];?></td>
            <td>
              <!-- boton Actualizar -->
              <form action="index.php" method="POST" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                  <input type="hidden" name="producto_id" value="<?php echo $p['producto_id'];?>">
                  <input type="number" name="precio" class="form-control" value="<?php echo $p['precio'];?>">
                  <button type="submit" class="btn btn-primary mb-2">Actualizar</button>
                </div>
              </form>
            </td>
            <td>
              <!-- boton Eliminar -->
              <form action="eliminar.php" method="POST" class="form">
              <input type="hidden" name="producto_id" value="<?php echo $p['producto_id'];?>">
              <input type="submit" value="Eliminar" class="btn btn-danger">
              </form>
            </td>
          </tr>
        </tbody>
      <?php
      }
      ?>
    </table>
  </div>
<?php
include('./plantillas/footer.php');