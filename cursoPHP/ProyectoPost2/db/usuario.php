<?php
/*
include 'conexion.php';

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
    //duda: como lo entiendo aqui, la asignacion en el foreach (linea 49) existe solo para lograr un casteo de tipo instancia de clase a array cierto? o en algun punto esperamos tener mas de una fila como resultado?
  }
  return $usuarioLogin;
}
?>