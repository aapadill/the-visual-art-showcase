<?php
  include('session.php');
  redirigirLogin(); //loop hasta que exista $_SESSION
  $nombre_usuario = $_SESSION['usuario'];
  
  $salir = isset($_GET['salir']) ?? '';
  ($salir == '1') ? cerrarSesion() : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
  <title>Registro Usuario Exitoso</title>
</head>
<body>
<header><h1>Bienvenido <?php echo $nombre_usuario;?> </h1></header>
<main>
  <section>
    <h2>Bienvenido</h2>
    <p>
      Usuario: <b> <?php echo $nombre_usuario;?></b>
    </p>
  </section>
  <section>
    <h2>Cerrar sesión</h2>
    <form action="index.php"> <!-- metodo por default es get -->
      <input type="hidden" name="salir" value="1"> <!-- campo oculto -->
      <input type="submit" value="Salir">
    </form>
  </section>
  
</main>
<footer>RedPost</footer>
</body>
</html>