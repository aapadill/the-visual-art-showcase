<?php
namespace Controladores;
use Modelos\Usuario;

class Sesion {
  
  public function __construct() {
    session_start();
  }

  public function getSesion() {
      return $_SESSION;
  }

  public function insertar($llave, $valor) {
    $_SESSION[$llave] = $valor;
  }

  public function obtener($llave) {
    $llaves = explode('.', $llave);
    $res = $_SESSION;

    $i = 0;
    while (isset($res) && $i < count($llaves)) {
      $res = $res[$llaves[$i]] ?? null;
      $i++;
    }
    return $res;
  }

  /**
   * Inserta en sesion el arreglo carritoCompra
   * con la llave del $productoId
   * 
   * @param int $productoId id del producto
   * @param array $producto arreglo con el siguiente fromato
   * $producto = [
   *    'cantidad' => 2,
   *    'precio_final' => 200
   * ]
   */
  public function insertarProducto($productoId, $producto) {
    if (!isset($_SESSION['productos'])) {
      $_SESSION['productos'] = [];
    }
    
    $_SESSION['productos'][$productoId] = $producto;
  }

  /**
  * Funcion que verifica que el Login sea valido
  * El Login es valido si el usuario y la contrasenia 
  * no son vacios y cumplen con las funciones
  * validarNombreUsuario y validarPassword
  *
  * Si el login es valido guarda $usuario
  * en session junto con la fecha y hora 
  * posterioromente redirige a la pagina de index.php
  *
  * @return boolean|string cuando el usuario no es valido
  * En caso de que el usuairo y contrasenia sean validos 
  * redirige al usuario a index.php 
  */
  public function validarLogin($usuario, $password) {
    $res = 'Usuario invalido';
    $validacion = false;
    $validacion = !empty($usuario) && !empty($password);
  
    // Redireccinamiento a index.php
    if ($validacion) {
      $usuarioBD = Usuario::validarLogin($usuario, $password);
      if (!empty($usuarioBD['usuario_id'])) {
        $_SESSION['usuario'] = $usuarioBD;
        Router::redireccionar('index.php');
      } else {
        $res = $usuarioBD;
      }
    }
    return $res;
  }
  
  /**
   * Redirige al usuario a login.php
   * en caso de que no haya iniciado la sesion
   * 
   * Se concidera que un usuario no ha iniciado session
   * si el usuario no esta presente en la variable $_SESSION
  */
  public function redirigirLogin() {
    if (empty($_SESSION['usuario'])) {
      Router::redireccionar('login.php');
    }
  }
  
  /**
   * Elimina todos los datos de la variable $_SESSION
   * Redirige al usuario a login.php
  */
  public function cerrarSesion() {
    unset($_SESSION['usuario']);
    session_destroy();
    Router::redireccionar('index.php');
  }
}