<?php
ob_start(); //buffering trick
require_once('../config/cargador.php');
use Modelos\Usuario;
use Controladores\Router;

include('./plantillas/header.php');

if (Router::esPost()){
  $registro = $_POST;

  $algunCampoVacio = empty($registro['name']) || empty($registro['username']) || empty($registro['password']) || empty($registro['email'] || empty($registro['profile_picture']));

  if (!$algunCampoVacio){
    $isAvailable = Usuario::checkUsernameOrEmail($registro['username'], $registro['email'], $usuarioIdSesion);
    //$usernameAlreadyExists = Usuario::consultar(0, $registro['username']); //too noisy in php, and we don't need an object yet so..
    if($isAvailable === 1){
      $usuarioOBJ = new Usuario($registro); //crear objeto datos
      $usuarioOBJ->insertar(); //insertar, el ID devuelto no es el esperado
      $usuarioI = Usuario::consultar(0,$usuarioOBJ->username);
      $sesion->insertar('usuario', $usuarioI);
      $sesion->insertar('welcomeValid', 1);
      Router::redireccionar('welcome.php'); //redireccion al welcome
    }
    else{
      //already considered
    }
  }
  if ($algunCampoVacio){
    echo 'error: llene todos los campos';
  }
}

?>
  <h1 class="mt-4 mb-4 text-center">Sign up</h1>
  <form class="form" action="" method="post" enctype="multipart/form-data">
    <!-- <input type="hidden" name="user_id" value=""> -->
    <!-- necessary? -->

    <div class="form-group">
      <label  class="col-md-8 offset-md-2" for="name">Name:</label>
      <div  class="col-md-8 offset-md-2">
        <input type="text" class="form-control" id="name" name="name" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="username">Username:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="username" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="password">Password:</label>
      <div class="col-md-8 offset-md-2">
        <input type="password" class="form-control" name="password" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="email">E-mail:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="email" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="profile_picture">Imagen:</label>
      <input type="hidden" name="profile_picture" value="">
      <div class="col-md-8 offset-md-2">
        <input type="file" class="form-control" name="profile_picture">
      </div>
    </div>

    <?php 
      if (isset($isAvailable) && $isAvailable != 1) {
      ?>
      <div class="form-group">
          <div class="col-md-8 offset-md-2 text-danger text-center">
            <b>
            <?php echo $isAvailable;?>
            </b>
          </div>
      </div>

      <br>
      <?php
      }
      ?>

    <br>
    <div class="col-md-8 offset-md-2">
      <button type="submit" class="btn btn-primary pull-right">Sign up</button>
    </div>
  </form>

<?php
include('./plantillas/footer.php');
?>