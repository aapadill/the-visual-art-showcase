<?php
include('session.php');
redirigirLogin();
$miVariable = $_SESSION['usuario'];

$salir = isset($_GET['salir']) ? $_GET['salir'] : '';
if ($salir == '1') {
  cerrarSesion();
}

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
<header><h1>Bienvenido RedPost <?php echo $miVariable?></h1></header>
<main>
  <section>
    <h2>Bienvenido</h2>
    <p>
      Usuario : <b><?php echo $miVariable;?></b>
    </p>
  </section>
  <section>
    <h2>Cerrar sesión</h2>
    <form action="index.php" method="GET">
      <input type="hidden" name="salir" value="1">
      <input type="submit" value="Salir">
    </form>
  </section>
  
</main>
<footer>RedPost</footer>
</body>
</html>