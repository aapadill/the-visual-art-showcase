<?php
$conexion = mysqli_connect("localhost", "root", "Welcome1", "social");
if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: " .  mysqli_connect_error();
    exit();
}

$resultados = mysqli_query($conexion, "SELECT * FROM posts;");
var_dump($resultados);
echo '<br>';
$todo = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
var_dump($todo);
mysqli_free_result($resultados);

$resultados = mysqli_query($conexion, "SELECT * FROM usuarios;");
foreach ($resultados as $renglon) {
  var_dump($renglon);
  echo '<br>';
}

mysqli_free_result($resultados);

mysqli_close($conexion);