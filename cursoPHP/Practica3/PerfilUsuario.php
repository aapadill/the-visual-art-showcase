<?php
  $nombre = "";
  $password = "";
  $sexo = "";
  $ocupacion = "";
  $perfil = "";
  $lenguajes = ["PHP", "Java"];
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
        <b>Nombre :</b> Jonathan <br>
        <b>Password :</b> HolaMundo!<br>
        <b>Sexo :</b> Masculino<br>
        <b>Ocupacion :</b> Estudiante<br>
    </p>
  </section>
  <section>
    <h2>Información General</h2>
    <b>Perfil :</b> Administrador <br>
    <b>Lenguajes :</b><br> 
    <ul>
      <li>PHP</li>
      <li>Java</li>
    </ul>
    <br>
  </section>

</main>
<footer>Mi Curso PHP</footer>
</body>
</html>