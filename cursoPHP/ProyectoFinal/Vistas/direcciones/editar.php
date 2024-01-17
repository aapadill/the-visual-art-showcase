<?php
include '../../config/cargador.php';
use Controladores\Router;

include Router::direccion('/plantillas/header.php');
?>

<form class="form" action="guardar.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="usuario_id" value="1">
  <div class="form-group">
    <label  class="col-md-8 offset-md-2" for="nombre">Nombre:</label>
    <div  class="col-md-8 offset-md-2">
      <input type="text" class="form-control" id="nombre" name="nombre">
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-8 offset-md-2" for="ap">Calle y numero:</label>
    <div class="col-md-8 offset-md-2">
      <input type="text" class="form-control" name="calle_numero">
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-8 offset-md-2" for="am">CP:</label>
    <div class="col-md-8 offset-md-2">
      <input type="text" class="form-control" name="cp">
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-8 offset-md-2" for="correo">Colonia:</label>
    <div class="col-md-8 offset-md-2">
      <input type="text" class="form-control" name="colonia">
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-8 offset-md-2" for="pwd">Municipio:</label>
    <div class="col-md-8 offset-md-2">
      <input type="text" class="form-control" name="municipio">
    </div>
  </div>


  <div class="form-group">
    <label class="col-md-8 offset-md-2" for="pwd">Estado:</label>
    <div class="col-md-8 offset-md-2">
      <input type="text" class="form-control" name="estado">
    </div>
  </div>
  <br>
  <div class="col-md-6 offset-md-6">
    <button type="submit" class="btn btn-primary pull-right">Guardar</button>
  </div>
</form>

<?php
include Router::direccion('/plantillas/footer.php');
?>