<?php
require_once 'validaciones.php';
// require_once 'session.php';
require_once('db/usuario.php');

$nombre = empty($_POST['nombre']) ? "" : htmlentities($_POST['nombre']);
$nombreUsuario = empty($_POST['nombre_usuario']) ? "" : htmlentities($_POST['nombre_usuario']);
$password = empty($_POST['password']) ? "" : htmlentities($_POST['password']);
$email = empty($_POST['email']) ? "" : htmlentities($_POST['email']);
$img_usuario = empty($_FILES['img_usuario']) ? [] : $_FILES['img_usuario'];
$datos = array();

$formularioLleno = !empty($nombre) && !empty($nombreUsuario) && !empty($password) && !empty($email) && !empty($img_usuario);

$datosValidados = validarNombre($nombre) && validarNombreUsuario($nombreUsuario) && validarPassword($password) && validarEmail($email) && validarImagen($img_usuario);

if ($formularioLleno && $datosValidados){
	$datos['nombre'] = $nombre; //deblish
	$datos['nombre_usuario'] = $nombreUsuario; //deb
	$datos['password'] = $password; //Abc123$
	$datos['email'] = $email; //x@deblish.com
	$datos['img_usuario'] = cargarImagen($img_usuario); //jpeg or png

	// var_dump($datos);
	$res = insertarUsuario($datos);
	// var_dump($res);
	session_start();
	$_SESSION['datos'] = $datos;
	header("Location: registroExito.php");

} if (!empty($_POST) && (!$formularioLleno || !$datosValidados)) {
	echo 'intenta de nuevo, algun campo esta vacio o no cumple la validacion';
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
	<header><h1>Registro RedPost</h1></header>
	<main>

<form method="POST" action="registro.php" enctype="multipart/form-data">
  	<label for="nombre">
		Nombre completo: 
		<input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>
	</label>
	<br>
  	<label for="nombre_usuario">
		Nombre de usuario: 
		<input type="text" name="nombre_usuario" value="<?php echo $nombreUsuario; ?>">
	</label>
	<br>
	<label for="password">
		Password: 
		<input type="password" name="password" value="<?php echo $password; ?>">
	</label>
	<br>
  	<label for="email">
		Correo electrónico: 
		<input type="text" name="email" value="<?php echo $email; ?>">
	</label>
	<br>
  	<label for="img_usuario">
		Imagen Usuario: 
		<input type="file" name="img_usuario">
	</label>
	<br>
	
	<input type="submit" value="Registrar">
</form>

</main>
<footer>Red POST</footer>
</body>
</html>

