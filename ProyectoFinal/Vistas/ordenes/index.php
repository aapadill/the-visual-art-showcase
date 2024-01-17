<?php
include_once '../../config/cargador.php';

use Controladores\Router;
use Modelos\Orden;

include Router::direccion('plantillas/header.php');

//admin
if ($rolSesion == '1'){
  // echo '<pre>';
  $detalleOrdenes = Orden::detalleOrden();
  // foreach ($detalleOrdenes as $orden){
    // $total = Orden::getTotalByOrden($orden['orden_id']);
    // var_dump($orden, $total);
  // }
}

//vendedor
if ($rolSesion == '2' || $rolSesion == '3'){ //el vendedor puede comprar? mmmmmmmmmm
  //$usuarioIdSesion;
  $ordenesUsuario = Orden::getOrdenIdByCompradorId($usuarioIdSesion);
  //echo '<pre>';
  // foreach ($ordenesUsuario as $ordenx){
  // $detalleOrdenes = Orden::detalleOrden($ordenx['orden_id']);
    // foreach ($detalleOrdenes as $orden){
      // $total = Orden::getTotalByOrden($orden['orden_id']);
      // var_dump($o);
    // }
  // }
}

// debug
// echo '<pre>';
// var_dump($productos);

?>
  <h4>Administrar Ordenes</h4>
  <br>
  <br>
  <table class="table table-hover">
    <!-- cabecera -->
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
    <!-- productos -->
    <?php
    if($rolSesion == '1'){
      $yaSeImprimio = '';
      if(!empty($detalleOrdenes)){
        foreach ($detalleOrdenes as $orden){
          if ($yaSeImprimio != $orden['orden_id']){
      ?>
          <tbody>
            <tr>
              <td><?php echo $orden['orden_id'];?></td>
              <td><?php echo $orden['comprador_id'];?></td>
              <td><?php echo $orden['direccion_id'];?></td>
              <td><?php echo $orden['status'];?></td>
              <td> $<?php echo Orden::getTotalByOrden($orden['orden_id'])?></td>
              <th>
                <!-- boton ver productos -->
                <form action="verProductos.php" method="GET" class="form">
                  <input type="hidden" name="orden_id" value="<?php echo $orden['orden_id'];?>">
                  <input type="submit" value="VerProductos" class="btn btn-primary">
                </form>
              </th>
              <td>
                <!-- boton eliminar -->
                <form action="eliminar.php" method="POST" class="form">
                <input type="hidden" name="orden_id" value="<?php echo $orden['orden_id'];?>">
                <input type="submit" value="Eliminar" class="btn btn-success">
                </form>
              </td>
            </tr>
          </tbody>
      <?php
          }
        $yaSeImprimio = $orden['orden_id'];
        }
      }
    }
    ?>

<?php
    if($rolSesion == '2' || $rolSesion == '3'){ //el vendedor puede comprar seeeehhh
      $yaSeImprimio = '';
      if(!empty($ordenesUsuario)){
        foreach ($ordenesUsuario as $ordenx){
          $detalleOrdenes = Orden::detalleOrden($ordenx['orden_id']);
            foreach ($detalleOrdenes as $orden){
              if ($yaSeImprimio != $orden['orden_id']){
      ?>
              <tbody>
                <tr>
                  <td><?php echo $orden['orden_id'];?></td>
                  <td><?php echo $orden['comprador_id'];?></td>
                  <td><?php echo $orden['direccion_id'];?></td>
                  <td><?php echo $orden['status'];?></td>
                  <td> $<?php echo Orden::getTotalByOrden($orden['orden_id'])?></td>
                  <th>
                    <!-- boton ver productos -->
                    <form action="verProductos.php" method="GET" class="form">
                      <input type="hidden" name="orden_id" value="<?php echo $orden['orden_id'];?>">
                      <input type="submit" value="VerProductos" class="btn btn-primary">
                    </form>
                  </th>
                  <td>
                    <!-- boton eliminar -->
                    <form action="eliminar.php" method="POST" class="form">
                    <input type="hidden" name="orden_id" value="<?php echo $orden['orden_id'];?>">
                    <input type="submit" value="Eliminar" class="btn btn-success">
                    </form>
                  </td>
                </tr>
              </tbody>
      <?php
              }
            }
        }
      $yaSeImprimio = $orden['orden_id'];
      }
    }
    ?>

  </table>

<?php
include Router::direccion('plantillas/footer.php');