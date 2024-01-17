<?php   
include_once '../config/cargador.php';

use Controladores\Router;

include Router::direccion('plantillas/header.php');
?>
<div class="row">
  <form class="form-horizontal" action="<?php Router::direccionWeb('login.php');?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="nombre_usuario">Nombre Usuario:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="nombre_usuario" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="password">Password:</label>
      <div class="col-md-8 offset-md-2">
        <input type="password" class="form-control" name="password" value="">
      </div>
    </div>
    <br>
    <div class="col-md-6 offset-md-6">
      <button type="submit" class="btn btn-primary pull-right">Guardar</button>
    </div>
  </form>
</div>
<?php
include Router::direccion('plantillas/footer.php');