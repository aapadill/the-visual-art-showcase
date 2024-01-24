<?php
  require_once('../config/cargador.php');
  use Modelos\Usuario;
  use Controladores\Sesion;
  use Controladores\Router;

  include('./plantillas/header.php');

  $usuario = new Usuario();

  $nombreUsuario = empty($_POST['username']) ? "" : htmlentities($_POST['username']);
  $password = empty($_POST['password']) ? "" : htmlentities($_POST['password']);

  $usuario->username = $nombreUsuario;
  $usuario->password = $password;

  // Procesar El inicio de sesion
  if (Router::esPost()) { //&& !$sesion //la peticion viene de post
    if (!empty($nombreUsuario) && !empty($password)) {
      //Comprobar que el usuario y contrasenia existen
      $usuarioL = Usuario::validarLogin($nombreUsuario, $password);
      //Redireccionamiento
      if (!empty($usuarioL->userID)) {
        var_dump($usuarioL);
        $sesion->insertar('usuario', $usuarioL);
        // if ($vieneDeCarrito){
          // unset($_SESSION['intento_compra']);
          // Router::redireccionar('carritoCompra/index.php');
        // }
        // if (!$vieneDeCarrito){
        Router::redireccionar('index.php');
        // }
      }
      else{
      //considerado //te quieres registrar mejor?
      }
    }
    else{
      var_dump("primero llena el formulario"); //no escribio en algun campo
    }
  }
  // else{ //la peticion no viene de post
  //   $sesion->cerrarSesion();
  // }
?>

<main>
<div class="container">
  <div class="row" id="login">
    <form class="form-horizontal" action="login.php" method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <label class="col-md-8 offset-md-2" for="username">Username:</label>
        <div class="col-md-8 offset-md-2">
          <input type="text" class="form-control" name="username" value="<?php echo $usuario->username;?>">
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
      <?php 
      if (!empty($usuarioL) && is_string($usuarioL)) {
      ?>
      <div class="form-group">
          <div class="col-md-8 offset-md-2 text-danger text-center">
            <b>
            <?php echo $usuarioL;?>
            </b>
          </div>
      </div>

      <br>
      <?php
      }
      ?>
      <!-- enviar, acomodar al centro -->
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary pull-right">Log in</button>
      </div>
    </form>
    <!-- registrar, acomodar al centro-->
    <div class="d-flex justify-content-center">
      <a href="<?php Router::direccionWeb("registrar.php")?>" class="btn btn-secondary pull-right">Sign up</a>
    </div>
  </div>
</div>
</main>

<?php
  include('./plantillas/footer.php');
?>