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

  // echo '<pre>';
  // echo '$_POST: ';
  // var_dump($_POST);

  // $vieneDeCarrito = $sesion->obtener('intento_compra') ?? 0;

 
  // Procesar El inicio de sesion
  if (Router::esPost()) {
    if (!empty($nombreUsuario) && !empty($password)) {
      //Comprobar que el usuario y contrasenia son correctos
      $usuarioL = Usuario::validarLogin($nombreUsuario, $password);
      // echo '<pre>';
      // echo '$usuarioL: ';
      // var_dump($usuarioL);
      //Redireccionamiento
      if (!empty($usuarioL->userID)) {
        $sesion->insertar('usuario', $usuarioL);
        // echo '<pre>';
        // echo '$sesion: ';
        // var_dump($sesion->getSesion());

        // if ($vieneDeCarrito){
          // unset($_SESSION['intento_compra']);
          // Router::redireccionar('carritoCompra/index.php');
        // }
        // if (!$vieneDeCarrito){
        Router::redireccionar('index.php');
        // }
      }
    }
  }
?>

<main>
<div class="container">
  <div class="row" id="login">
  <form class="form-horizontal" action="login.php" method="POST" enctype="multipart/form-data">
    
    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="username">Nombre Usuario:</label>
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
    <br>

    <div class="col-md-6 offset-md-6">
      <button type="submit" class="btn btn-primary pull-right">Guardar</button>
    </div>
     
  </form>
  </div>
</div>
</main>

<?php
// include('./plantillas/footer.php');
?>