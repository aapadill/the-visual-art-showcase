<?php
// require_once 'session.php';
session_start();

if (isset($_SESSION['datos'])) {
  $nombreUsuario = $_SESSION['datos']['nombre_usuario'];
  $email = $_SESSION['datos']['email'];
  $nombre = $_SESSION['datos']['nombre'];
  $img_usuario = $_SESSION['datos']['img_usuario'];
  // var_dump($_SESSION);
} else {
  header("Location: registro.php");
}

$salir = isset($_GET['salir']) ? $_GET['salir'] : '';
if ($salir == '1') {
  unset($_SESSION['datos']);
  session_destroy();
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
<header><h1>RedPost</h1></header>
<main>
  <section>
    <h2>Imagen Usuario</h2>
    <figure>
      <img alt="Imagen de usuario" src="<?php echo $img_usuario; ?>" />
      <figcaption>Imagen de perfil</figcaption>
    </figure>
    <p>
        <b>Nombre Usuario : <?php echo $nombreUsuario; ?> <br>
        <b>Correo electrónico : <?php echo $email; ?> <br>
        <b>Nombre Completo:</b> <?php echo $nombre; ?> <br>
    </p>
  </section>
  <section>
    <h2>Inicia sesión</h2>
    <!-- <a href="login.php"><button>Iniciar sesion</button></a> -->
    <form action="login.php" method="GET"> 
      <input type="hidden" name="salir" value="1">
      <input type="submit" value="Iniciar sesion">
    </form>
    <br>
  </section>

</main>
<footer>RedPost</footer>
</body>
</html>