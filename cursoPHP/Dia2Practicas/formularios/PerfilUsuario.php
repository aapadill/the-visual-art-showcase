<?php
  // var_dump($_GET);
  // var_dump($_POST);
  $nombre = isset($_POST['mail']) ? $_POST['mail'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
  $ocupacion = isset($_POST['ocupacion']) ? $_POST['ocupacion'] : '';
  $perfil = isset($_POST['perfil']) ? $_POST['perfil'] : '';
  $lenguajes = isset($_POST['lenguaje']) ? $_POST['lenguaje'] : [];

  if (isset($_FILES['img_perfil']['name'])) { //duda, aqui va un isset?, no esta asignando el nombre 'user.png' si files no existe
    $nombreArchivo = $_FILES['img_perfil']['name'];
    move_uploaded_file($_FILES['img_perfil']['tmp_name'], $_FILES['img_perfil']['name']);
  }
  else{
    $nombreArchivo = 'user.png';
  }
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
      <img alt="User Image" src="<?php echo $nombreArchivo;?>" />
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
    <b>Perfil :</b> <?php echo $perfil;?> <br>
    <b>Lenguajes :</b><br> 
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