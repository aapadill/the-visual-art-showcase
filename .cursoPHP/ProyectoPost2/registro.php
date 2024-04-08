<?php
require_once 'validaciones.php';

$nombre = empty($_POST['nombre']) ? "" : htmlentities($_POST['nombre']);
$password = empty($_POST['password']) ? "" : htmlentities($_POST['password']);
$email = empty($_POST['email']) ? "" : htmlentities($_POST['email']);
$nombreUsuario = empty($_POST['nombre_usuario']) ? "" : htmlentities($_POST['nombre_usuario']);

// Insertar Imagenes

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
		<input type="password" name="password" value="">
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

