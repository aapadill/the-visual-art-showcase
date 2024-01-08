<?php
include_once 'db/conexion.php';
include_once 'db/post.php';
include_once 'session.php';
include_once 'validaciones.php';

redirigirLogin();
//var_dump($_SESSION);

$session = $_SESSION['usuario'] ?? '';
$id = $session['usuario_id'];

$resultados = queryPost($id);

$salir = isset($_GET['salir']) ? $_GET['salir'] : '';
if ($salir == '1') {
  cerrarSesion();
}

$texto = $_POST['texto'] ?? '';
if (!empty($texto)){
  $imagen = '';
  $archivo = $_FILES['img_post'] ?? [];
  if (!empty($archivo)){
    $imagen = cargarImagenPost($archivo);
  }
  
  var_dump($imagen);

  crearPost($id, $texto, $imagen);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
  <title>Registro Usuario Exitoso</title>
  <style>
    .sticky {
      position: -webkit-sticky;
      position: sticky;
      top: 0;
      background: white;
    }
  </style>
</head>
<body>
<header>
  <h1>Bienvenido RedPost</h1>
  <nav>
    
    <form action="index.php" method="GET"> 
      <!-- era POST -->
      <input type="hidden" name="salir" value="1">
      <input type="submit" value="Salir">
    </form>
    <a href="seguir.php">Amigos</a>
  </nav>
</header>

<main>
  <section class="sticky">
    <details>
      <summary>
        Publicar
      </summary>
      <p>
        <form action="index.php" enctype="multipart/form-data" method="POST">
          <textarea name="texto" rows="3">Post</textarea>
          <input type="file" name="img_post">
          <input type="submit" value="Publicar">
        </form>
      </p>
    </details>
  </section>

  <section id="posts">
    <?php
    foreach ($resultados as $datos) {
    ?>
    <article>
      <div>
        <img src="<?php echo $datos['img_usuario']; ?>" alt="User" width="100" height="100">
        <b><?php echo $datos['nombre_usuario']; ?></b>
      </div>
      <p>
        <?php echo $datos['texto'];?>
      </p>
      <img src="<?php echo $datos['img_post']; ?>" alt="post" width="800" height="800">
      </figure>
    </article>
    <?php
    }
    ?>
  </section>  
</main>
<footer>
  RedPost
</footer>
</body>
</html>