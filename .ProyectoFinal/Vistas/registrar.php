<?php
require_once('../config/cargador.php');
use Modelos\Usuario;
use Controladores\Router;

include Router::direccion('plantillas/header.php');

if (Router::esPost()){ //6.a) //la base de datos permite usuarios iguales? Xd
  $registro = $_POST; //arreglo
  //echo debug
  echo '<pre>';
  echo '$_POST: ';
  var_dump($_POST);

  $algunCampoVacio = empty($registro['nombre']) || empty($registro['nombre_usuario']) || empty($registro['password']) || empty($registro['email'] || empty($registro['img_usuario']));

  if (!$algunCampoVacio){
    $usuarioOBJ = new Usuario($registro);
    $usuarioOBJ->guardar(); //6.b guardar datos
  
    echo '$usuarioOBJ: ';
    var_dump($usuarioOBJ);
    Router::redireccionar('index.php'); //6.c)
  }
  if ($algunCampoVacio){
    echo 'error: llene todos los campos';
  }
}

?>
  <form class="form" action="registrar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="usuario_id" value="">
    <div class="form-group">
      <label  class="col-md-8 offset-md-2" for="nombre">Nombre:</label>
      <div  class="col-md-8 offset-md-2">
        <input type="text" class="form-control" id="nombre" name="nombre" value="">
      </div>
    </div>

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

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="email">E-Mail:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="email" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="imagen_archivo">Imagen:</label>
      <input type="hidden" name="img_usuario" value="">
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