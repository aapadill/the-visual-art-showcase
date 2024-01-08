<?php
  $nombre = "Aaron";
  $password = "abecedario";
  $sexo = "M";
  $ocupacion = "Estudiante";
  $perfil = "Administrador";
  $lenguajes = ["Javascript", "Ruby", "C", "Python"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
  <title>Perfil Usuario</title>
</head>
<body>
<header><h1>Mi Perfil</h1></header>
<main>
  <section>
    <h2>Información Personal</h2>
    <figure>
      <img alt="User Image" src="user.png" />
      <figcaption>Imagen Usuario</figcaption>
    </figure>
    <p>
        <b>Nombre :</b> <?php echo $nombre;?> <br>
        <b>Password :</b> <?php echo $password;?> <br>
        <b>Sexo :</b> <?php echo $sexo;?> <br>
        <b>Ocupacion :</b> <?php echo $ocupacion;?> <br>
    </p>
  </section>
  <section>
    <h2>Información General</h2>
    <b>Perfil :</b> <?php echo $ocupacion;?> <br>
    <b>Lenguajes :</b> <br> 
    <ul>
      <?php foreach($lenguajes as $valor){  ?>
      <li>
      <?php echo $valor;?>
      </li>
      <?php } ?>
    </ul>
    <br>  
  </section>

</main>
<footer>Mi Curso PHP</footer>
</body>
</html>