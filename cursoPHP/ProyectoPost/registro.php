<?php
require_once('validaciones.php');
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
		<input type="text" name="nombre">
	</label>
	<br>
  <label for="nombre_usuario">
		Nombre de usuario: 
		<input type="text" name="nombre_usuario">
	</label>
	<br>
	<label for="password">
		Password: 
		<input type="password" name="password">
	</label>
	<br>
  <label for="email">
		Correo electrónico: 
		<input type="text" name="email">
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