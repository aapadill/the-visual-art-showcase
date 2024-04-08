<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
	<header><h1>Login RedPost</h1></header>
	<main>
<form method="POST" action="index.php">
	<input type="hidden" name="id" value="0">
	<label for="nombre">
		Nombre usuario: 
		<input type="text" name="usuario" value="<?php echo $nombre; ?>">
	</label>
	<br>
	<label for="nombre">
		Password: 
		<input type="password" name="password" value="">
	</label>

	<input type="submit" value="Registrar">
</form>

</main>
<footer>RedPost</footer>
</body>
</html>