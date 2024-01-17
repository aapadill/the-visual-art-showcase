<?php
require_once('../../config/cargador.php');
use Controladores\Router;


include Router::direccion('plantillas/header.php');
?>
<div class="row">
  <form class="form-horizontal" action="guardar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="producto_id" value="">
    <div class="form-group">
      <label  class="col-md-8 offset-md-2" for="nombre">Nombre:</label>
      <div  class="col-md-8 offset-md-2">
        <input type="text" class="form-control" id="nombre" name="nombre" value="">
      </div>
    </div>
    <br>
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="descripcion">Descripcion:</label>
      <div class="col-md-8 offset-md-2">
        <textarea name="descripcion" class="form-control" rows="5" value=""></textarea>
      </div>
    </div>
    <br>
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="precio">Precio:</label>
      <div class="col-md-8 offset-md-2">
        <input type="number" min="1" class="form-control" name="precio" value="">
      </div>
    </div>
    <br>
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="vendedorr_id">Vendedor:</label>
      <div class="col-md-8 offset-md-2">
        <select name="rol_id" class="form-control" value="">
          <option value="1">vendedor</option>
          <option value="2">vendedor</option>
          <option value="3">vendedor</option>
        </select>
      </div>
    </div>
    <br>
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="imagen_archivo">Imagen:</label>
      <input type="hidden" name="img_usuario" value="">
      <div class="col-md-8 offset-md-2">
        <input type="file" class="form-control" name="imagen_archivo">
      </div>
    </div>
    
    <br>
    <div class="col-md-3 offset-md-6">
    <button type="submit" class="btn btn-primary pull-right">Guardar</button>
      <a href="index.php" type="submit" class="btn btn-secondary pull-right">Cancelar</a>
    </div>
  </form>
</div>
<?php
include Router::direccion('plantillas/footer.php');
?>