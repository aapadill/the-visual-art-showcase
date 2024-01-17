<?php
require_once('../config/cargador.php');
use Modelos\Usuario;
use Controladores\Router;


include Router::direccion('plantillas/header.php');
?>
  <form class="form" action="<?php Router::direccionWeb('registrar.php');?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="usuario_id" value="<?php echo $usuario->usuarioId;?>">
    <div class="form-group">
      <label  class="col-md-8 offset-md-2" for="nombre">Nombre:</label>
      <div  class="col-md-8 offset-md-2">
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario->nombre;?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="nombre_usuario">Nombre Usuario:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="nombre_usuario" value="<?php echo $usuario->nombreUsuario;?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="password">Password:</label>
      <div class="col-md-8 offset-md-2">
        <input type="password" class="form-control" name="password" value="<?php echo $usuario->password;?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="email">E-Mail:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="email" value="<?php echo $usuario->email;?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="imagen_archivo">Imagen:</label>
      <input type="hidden" name="img_usuario" value="<?php echo $usuario->imgUsuario;?>">
      <div class="col-md-8 offset-md-2">
        <input type="file" class="form-control" name="imagen_archivo">
      </div>
    </div>
    <br>
    <div class="col-md-6 offset-md-6">
      <button type="submit" class="btn btn-primary pull-right">Guardar</button>
    </div>
  </form>

<?php
include Router::direccion('plantillas/footer.php');
?>