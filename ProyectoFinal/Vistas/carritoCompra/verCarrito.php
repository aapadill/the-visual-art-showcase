<?php
// use Controladores\Router;

use Controladores\Router;
use Modelos\Direccion;
use Modelos\Orden;
use Controladores\Sesion;

// echo '<pre>';
// var_dump($productosSesion);
$total = 0;
$direccion = [];

//Muestra diferentes direcciones dependiendo de rolSesion
// if (Router::esGet()){
  if ($rolSesion == '1'){
    $direccion = Direccion::listarAdmin();
  }

  if ($rolSesion == '2' || $rolSesion == '3'){
    $direccion = Direccion::listar($usuarioIdSesion);
  }
// }
  if (Direccion::contar($direccion) < 1) {
    var_dump(Direccion::contar($direccion));
  }

if (Router::esPost()){ //4.b.v.1) Debe ser procesado por el mismo archivo
  // $sesion = new Sesion();
  if (!empty($usuarioSesion) && !empty($productosSesion)){
    $orden = $_POST; //arreglo
    //echo debug
    echo '<pre>';
    echo '$orden: ';
    var_dump($orden);
    
    if(!empty($orden['direccion_id']) && !empty($orden['comprador_id'])){
      $ordenOBJ = new Orden($orden, $productosSesion);
      $ordenOBJ->insertar(); //4.b.v.3) Guardar los datos con Orden::insertar

      echo '$ordenOBJ: ';
      var_dump($ordenOBJ);
      Router::redireccionar('ordenes/index.php');
    }

    if(empty($orden['direccion_id'])){
      echo '<br>';
      echo 'seleccione una direccion, si no tiene, por favor añada alguna';
    }

    if(empty($orden['comprador_id'])){
      echo '<br>';
      echo 'wtf como llegaste aqui?';
    }
  }
}
?>

  <h1>Productos</h1>
  <!-- tabla del carrito -->
  <table class="table table-hover">
      <!-- cabecera de tabla -->
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Cantidad</th>
          <th>Nombre del producto</th>
          <th>Imagen</th>
          <th>Precio</th>
          <th>Total</th>
        </tr>
      </thead>
      <!-- 4.b.iii) se imprimen los n productos -->
      <tbody>
          <?php 
          foreach ($productosSesion as $producto) {
            $total += $producto['precio_final'] * $producto['cantidad']; 
          ?>
          <tr>        
            <td><?php echo $producto['producto_id']; ?></td>
            <td><?php echo $producto['cantidad']; ?></td>
            <td><?php echo $producto['nombre']; ?></td>
            <td><img class="img-thumbnail" width="70px" src="<?php echo $producto['imagen']; ?>" alt="..."></td>
            <td>$<?php echo $producto['precio_final']; ?></td>
            <td>$<?php echo $producto['precio_final'] * $producto['cantidad']; ?></td> 
          </tr>
          <?php 
          }
          ?>
      </tbody>
    </table>
        
    <!-- 4.b.iv) total de carrito -->
    <h5>Total de compra: $<?php echo $total; ?></h5> 
    
    <!-- 4.b.v.5) POST comprar, reedirige a ../ordenes/index.php-->
    <form action="<?php Router::direccion('carritoCompra/index.php');?>" method="POST"> 
      <!-- usuario_id, valor usuarioIdSesion-->
      <input type="hidden" name="comprador_id" value="<?php echo $usuarioIdSesion ?>"> 
      
      <!-- lista de direcciones disponibles -->
      <?php
        // var_dump(Direccion::contar($direccion));
        if (Direccion::contar($direccion) < 1) {
      ?>    
        <a href="../direcciones/editar.php" class="btn btn-secondary pull-right">Añadir una direccion primero</a>
      <?php
        }else{
      ?>
        <div class="form-group">
          <label class="col-md-8 offset-md-2" for="estado">Direccion:</label>
          
          <?php
          if ($rolSesion == '1'){
          ?>
          <label class="col-md-8 offset-md-2" for="estado"> (<b>admin</b> puede ver todas las direcciones) </label>
          <?php
          }
          ?>

          <div class="col-md-8 offset-md-2">
            <!-- 4.b.v.2) mostrar las direcciones del usuario, si admin se muestra todo -->
            <select name="direccion_id" class="form-control">
            <?php
              foreach ($direccion as $d) {
            ?>          
              <option value="<?php echo $d['direccion_id'];?>"> <?php echo $d['nombre']; ?> </option>      
            <?php
            }
            ?>      
            </select>
          </div>
        </div>
        <input type="submit" class="btn btn-info" value="Comprar">
      <?php
        }
      ?>
    </form>
  <br>

  