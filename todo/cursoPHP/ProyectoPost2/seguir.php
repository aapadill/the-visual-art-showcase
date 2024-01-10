<?php
  include('db/conexion.php');
  include('db/seguidor.php');
  include_once 'session.php';
  include_once 'validaciones.php';

  redirigirLogin();
  $sesion = $_SESSION['usuario'] ?? '';
  $usuarioID = $sesion['usuario_id'];

  // $usuario_id = 1;
  // $seguidor_id = 3;
  // $seguidor_id = 3;

  $usuarioTablaSeguidores = $_POST['usuario_id'] ?? '';
  if(!empty($usuarioTablaSeguidores)){
    $seguir = $_POST['seguir'] ?? '';
    if(!empty($seguir)){
      $res = seguir($usuarioTablaSeguidores, $usuarioID);
    }

    $seguir = $_POST['no_seguir'] ?? '';
    if(!empty($seguir)){
      $res = dejarSeguir($usuarioTablaSeguidores, $usuarioID);
    }
  }

  $usuarios = listarSeguidores($usuarioID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
  <title>Amigos</title>
</head>
<body>
<header>
  <h1>Usuario</h1>
  <nav>
    <form action="index.php" method="POST">
      <input type="hidden" name="salir" value="1">
      <input type="submit" value="Salir">
    </form>
    <a href="index.php">Inicio</a>
  </nav>
</header>

<main>
  <table>
    <thead>
      <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th style="width: 200px;">Seguir</th>
      </tr>
    </thead>
    <tbody>

    <?php
      foreach($usuarios as $usuario){
    ?>
        <tr>
        <td>
          <img src="<?php echo $usuario['img_usuario'];?>" alt="" width="100" height="100">
        </td>
        <td><?php echo $usuario['nombre_usuario'];?></td>
        <td>
          <div>
          <form action="seguir.php" method="POST">
            <input type="hidden" name="usuario_id" value="<?php echo $usuario['usuario_id'];?>">
            <?php
              if (empty($usuario['seguido'])){
            ?>
            <input type="hidden" name="seguir" value="1">
            <input type="submit" value="Seguir">
            <?php
              }else{
            ?>
            <input type="hidden" name="no_seguir" value="1">
            <input type="submit" value="Dejar Seguir">
            <?php
            }
            ?>
          </form>
          </div>
        </td>
      </tr>
    <?php
      }
    ?>
      <!-- <tr>
        <td>
          <img src="img/usuarios/user.png" alt="" width="100" height="100">
        </td>
        <td>Red Night Mare</td>
        <td>
          <form action="seguir.php">
            <input type="hidden" name="usuario_id" value="1">
            <input type="hidden" name="no_seguir" value="1">
            <input type="submit" value="Dejar Seguir">
          </form>
        </td>
      </tr> -->
    </tbody>
  </table>  
</main>
<footer>
  RedPost
</footer>
</body>
</html>