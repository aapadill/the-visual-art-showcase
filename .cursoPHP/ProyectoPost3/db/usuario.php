<?php
include 'conexion.php';

/*
$usuario = 'leo';
$password = 'Hola1234';
$login = verificarLogin($usuario, $password);
var_dump($login);*/
/**

* Inserta un usuario en la tabla usuario
* Utiliza la query 
INSERT INTO usuarios (nombre_usuario, password, email, nombre, img_usuario) VALUES
  ('leon', 'Hola1234', 'test5@test.com', 'Leon', 'img/usuarios/user.png')
*
* 
* @param array con los datos de usuario
*/
function insertarUsuario($datos) {
  //abrir conexion
  $conexion = abrirConexion();
  //limpiar Datos
  $nombre = limpiarDatos($conexion, $datos['nombre']);
  $nombreUsuario = limpiarDatos($conexion, $datos['nombre_usuario']);
  $password = limpiarDatos($conexion, $datos['password']);
  $email = limpiarDatos($conexion, $datos['email']);
  $img_usuario = limpiarDatos($conexion, $datos['img_usuario']);

  //nombreUsuario o email ya existe
  if (usuarioExiste($conexion, $nombreUsuario, $email)) {
    return "usuario o email ya existe";
  }

  //usuarioExiste ejecuto query, necesitamos abrir la conexion otra vez
  $conexion = abrirConexion();

  $sql = "INSERT INTO usuarios (nombre_usuario, password, email, nombre, img_usuario) VALUES ('$nombreUsuario', '$password', '$email', '$nombre', '$img_usuario')";
  $resultado = ejecutarQuery($conexion, $sql);
  return $resultado;
}

//evita inserciones de nombreUsuario o email ya existentes
function usuarioExiste($conexion, $nombreUsuario, $email) {
  $sql = "SELECT COUNT(*) AS count FROM usuarios WHERE nombre_usuario = '$nombreUsuario' OR email = '$email'";
  $resultado = ejecutarQuery($conexion, $sql);
  $row = mysqli_fetch_assoc($resultado);
  return ($row['count'] > 0);
}

/**
* Verifica que el usuairo y Contrasenia correspondan a un usuario
* y regresa los dato del usuario
* Utiliza la query 
  SELECT  usuario_id, nombre_usuario, email, nombre, img_usuario
  FROM usuarios
  WHERE
    nombre_usuario = 'leon'
    AND password = 'Hola1234'
* @param array con los datos de usuario
*/
function verificarLogin($usuario, $password) {
  $usuarioLogin = false;
  $conexion = abrirConexion();
  $sql = "
    SELECT  usuario_id, nombre_usuario, email, nombre, img_usuario
    FROM usuarios
    WHERE
      nombre_usuario = '$usuario'
      AND password = '$password'
  ";
  $login = ejecutarQuery($conexion, $sql);
  
  foreach ($login as $valor) {
    $usuarioLogin = $valor;
    //esto existe solo para lograr un casteo de tipo instancia de clase a array cierto, nunca esperamos tener mas de una fila como resultado
  }
  return $usuarioLogin;
}
?>