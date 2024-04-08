<?php
include_once 'UsuariosBD.php';
session_start();

$usuarioId  = '';
if (isset($_GET['usuario_id'])) {
	$usuarioId = $_GET['usuario_id'] ?? '';

}

if (isset($_SESSION['usuario'])) {
	$usuario = $_SESSION['usuario'];
	$usuarioId = isset($_SESSION['usuario']['usuario_id']) ? htmlentities($_SESSION['usuario']['usuario_id']) : '';
	unset($_SESSION['usuario']);
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


<form method="POST" action="guardarUsuario.php">
  <input type="hidden" name="usuario_id" value="<?php echo $usuarioId; ?>">
  <label for="nombre">
		Nombre completo: 
		<input type="text" name="nombre" value="<?php echo $nombre; ?>">
	</label>
	<br>
  <label for="nombre_usuario">
		Nombre de usuario: 
		<input type="text" name="nombre_usuario" value="<?php echo $nombreUsuario; ?>">
	</label>
	<br>
	<label for="password">
		Password: 
		<input type="password" name="password">
	</label>
	<br>
  <label for="email">
		Correo electrónico: 
		<input type="text" name="email" value="<?php echo $email; ?>">
	</label>
	<br>
	<input type="submit" value="Registrar">
</form>

</main>
<footer>Red POST</footer>
</body>
</html>