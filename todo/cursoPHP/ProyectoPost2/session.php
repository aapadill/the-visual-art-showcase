<?php
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
* En caso de que el usuario y contrasenia sean validos 
* redirige al usuario a index.php 
*/
function validarLogin($usuario, $password) {
  $res = false;
  $res = !empty($usuario) && !empty($password);
  //&& validarNombreUsuario($usuario) && validarPassword($password);

  // Redireccinamiento a index.php
  if ($res) {
    $login = verificarLogin($usuario, $password);    

    if (!empty($login)) { //cambiar a coalescing operator '??'
      $_SESSION['usuario'] = $login;
      header("Location: index.php"); // Terminar El 
    }
  }
  // No se ejecutado
 return $res;
}

/*
* Redirige al usuario a login.php
* en caso de que no haya iniciado la sesion
*
* Se concidera que un usuario no ha iniciado session
* si el usuario no esta presente en la variable $_SESSION
*/
function redirigirLogin() {
  if (empty($_SESSION['usuario'])) { // Indice que no existe 
    //No inicializada, False Cadena vacia, Un arreglo Vacio
    header("Location: login.php");  
  }
}

/*
* Elimina todos los datos de la variable $_SESSION
* Redirige al usuario a login.php
*/
function cerrarSesion() {
  unset($_SESSION['usuario']);
  session_destroy();
  header("Location: login.php");  
}

function redirigirIndex() {
  if (isset($_SESSION['usuario'])) { // Indice que no existse 
    //No inicializada, False Cadena vacia, Un arregoo Vacio
    header("Location: index.php");  
  }
}
?>