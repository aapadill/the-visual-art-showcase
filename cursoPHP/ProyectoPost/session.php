<?php
include('validaciones.php');
session_start();
/*
* Funcion que verifica que el Login sea valido
* El Login es valido si el usuario y la contrasenia 
* no son vacios y cumplen con las funciones
* validarNombreUsuario y validarPassword
*
* Si el login es valido guarda $usuario
* en session junto con la fecha y hora 
* posterioromente redirige a la pagina de index.php
* 
* @return false cuando el usuario no es valido
* En caso de que el usuairo y contrasenia sean validos 
* redirige al usuario a index.php 
*/
function validarLogin($usuario, $password) {
  $res = false;
	$res = !empty($usuario) && validarNombreUsuario($usuario) && !empty($password) && validarPassword($password);

  // Redireccinamiento a index.php
  if ($res) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.php");
  }
	return $res;
}

/*
* Redirige al usuario a login.php
* en caso de que no haya iniciado la sesion
* Se concidera que un usuario no ha iniciado session
* si el usuario no esta presente en la variable $_SESSION
*/
function redirigirLogin() {
  // if (empty($_SESSION['usuario'])) {
  //   header("Location: login.php");
  // }
  (empty($_SESSION['usuario'])) ? header("Location: login.php") : '';
}

/*
* Elimina todos los datos de la variable $_SESSION
* Redirige al usuario a login.php
*/
function cerrarSesion() {
  unset($_SESSION['usuario']);
  //session_destroy();
  header("Location: login.php");
}

function redirigirIndex(){
  (isset($_SESSION['usuario'])) ? header("Location: index.php") : '';
}
?>

