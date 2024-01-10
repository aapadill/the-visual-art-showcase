<?php
require_once('../config/cargador.php');
use Modelos\Usuario;
use Controladores\Sesion;
use Controladores\Router;

$sesion = new Sesion();
$usuario = new Usuario();

$nombreUsuario = empty($_POST['nombre_usuario']) ? "" : htmlentities($_POST['nombre_usuario']);
$password = empty($_POST['password']) ? "" : htmlentities($_POST['password']);

$usuario->nombreUsuario = $nombreUsuario;
$usuario->password = $password;

// Procesar El inicio de sesion
if (Router::esPost()) {
  if (!empty($nombreUsuario) && !empty($password)) {
    //Comprobar que el usauario y contrasenia son correctos
    $usuarioL = Usuario::validarLogin($nombreUsuario, $password);
    var_dump($usuarioL);
    //Redireccionamiento
    if (!empty($usuarioL->usuarioId)) {
      $sesion->insertar('usuario', $usuarioL);
      header('Location: index.php');
    }
  }
}

include('./plantillas/header.php');
?>
<main>
<div class="container">
  <div class="row" id="login">
  <form class="form-horizontal" action="login.php" method="POST" enctype="multipart/form-data">
    
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
include('./plantillas/footer.php');
?>