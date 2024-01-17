<?php
require_once('../../config/cargador.php');
use Modelos\Usuario;
use Controladores\Router;

$usuario = new Usuario();

// Llenar usuario para edicion
if (!empty($_GET['usuario_id'])) {
  $id = intval($_GET['usuario_id']);
  $usuario = Usuario::consultar($id);
}

include Router::direccion('plantillas/header.php');
?>
<div class="row">
  <form class="form-horizontal" action="guardar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="usuario_id" value="<?php echo $usuario->usuarioId;?>">
    <div class="form-group">
      <label  class="col-md-8 offset-md-2" for="nombre">Nombre:</label>
      <div  class="col-md-8 offset-md-2">
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario->nombre;?>">
      </div>
    </div>
    <br>
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="nombre_usuario">Nombre Usuario:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="nombre_usuario" value="<?php echo $usuario->nombreUsuario;?>">
      </div>
    </div>
    <br>
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="password">Password:</label>
      <div class="col-md-8 offset-md-2">
        <input type="password" class="form-control" name="password" value="<?php echo $usuario->password;?>">
      </div>
    </div>
    <br>
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="email">E-Mail:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="email" value="<?php echo $usuario->email;?>">
      </div>
    </div>
    <br>
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="imagen_archivo">Imagen:</label>
      <input type="hidden" name="img_usuario" value="<?php echo $usuario->imgUsuario;?>">
      <div class="col-md-8 offset-md-2">
        <input type="file" class="form-control" name="imagen_archivo">
      </div>
    </div>
    <br>
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="estado">Rol:</label>
      <div class="col-md-8 offset-md-2">
        <select name="rol_id" class="form-control" value="<?php echo $usuario->rolId;?>">
          <option value="1">Administrador</option>
          <option value="2">Comprador</option>
          <option value="2">Vendedor</option>
        </select>
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