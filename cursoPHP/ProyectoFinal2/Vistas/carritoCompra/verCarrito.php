<?php //algo anda mal
use Controladores\Router;
use Modelos\Direccion;
use Controladores\Sesion;

$sesion = new Sesion();
$productosSesion = $sesion->obtener('productos') ?? [];
echo '<pre>';
var_dump($productosSesion);
$total = 0;

?>
    <h4>Compra Total : $5000</h4>
    <form action="comprar.php" method="POST">
      <input type="hidden" name="usuario_id" value="1">
      <div class="form-group">
				<label class="col-md-8 offset-md-2" for="estado">Direccion:</label>
				<div class="col-md-8 offset-md-2">
					<select name="direccion_id" class="form-control">
            
            <option value="1">Casa</option>            
            <option value="3">Default</option>
            <option value="2">Oficina</option>
          </select>
				</div>
			</div>
      <input type="submit" class="btn btn-info" value="Comprar">
    </form>
  <br>
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
      <?php
        foreach($productosSesion as $producto){
          $total += $producto['precio_final'] * $producto['cantidad'];
      ?>
        <tr>        
          <td> <?php echo $producto['producto_id']; ?></td>
          <td> <?php echo $producto['cantidad']; ?></td>
          <td> <?php echo $producto['precio_final']; ?></td>
          <td> <?php echo $producto['precio_final'] * $producto['cantidad']; ?></td>
        </tr>
      <?php
        }
      ?>
    </tbody>
  </table>