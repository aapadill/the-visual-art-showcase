<?php
require_once('session.php');
require_once('validaciones.php');
require_once('db/usuario.php');
require_once('db/conexion.php');

$nombre = empty($_POST['nombre_usuario']) ? "" : htmlentities($_POST['nombre_usuario']);
$password = empty($_POST['password']) ? "" : htmlentities($_POST['password']);

validarLogin($nombre, $password);
redirigirIndex();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
	<header><h1>Login RedPost</h1></header>
	<main>
<form method="POST" action="login.php">
	<input type="hidden" name="id" value="0">
	<label for="nombre">
		Nombre usuario: 
		<input type="text" name="nombre_usuario" value="<?php echo $nombre; ?>">
	</label>
	<br>
	<label for="nombre">
		Password: 
		<input type="password" name="password" value="<?php echo $password; ?>">
	</label>

	<input type="submit" value="Login">
</form>
<a href="registro.php"><button>Registrar</button></a>
</main>
<footer>RedPost</footer>
</body>
</html>