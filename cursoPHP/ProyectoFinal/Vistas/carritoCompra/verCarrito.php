<?php
use Controladores\Router;
use Modelos\Direccion;


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
        <tr>        
          <td>1</td>
          <td>2</td>
          <td>400</td>
          <td>800</td>
        </tr>
    </tbody>
  </table>