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

  public function insertarProducto($productoId, $producto, $cantidad) {
    // //si no existe $SESSION['productos'], definelo como cadena vacia
    // if (!isset($_SESSION['productos'])){
    //   $_SESSION['productos'] = [];
    // }
    // //si existe $SESSION['productos']
    //   //si cantidad es cero
    //   if ($cantidad == 0){
    //     //si existe ['productoID']
    //     if (isset($_SESSION['productos'][$productoId])){
    //       unset($_SESSION['productos'][$productoId]);//eliminarProducto
    //     }
    //   }

    //   //si cantidad es mayor a cero
    //   if ($cantidad > 0){
    //     //añade el $POST a la $SESSION en $productos x $productoID
    //     $_SESSION['productos'][$productoId] = $producto;
    //   }
  }

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
  
  public function redirigirLogin() {
    if (empty($_SESSION['usuario'])) {
      Router::redireccionar('login.php');
    }
  }
  
  public function cerrarSesion() {
    unset($_SESSION['usuario']);
    session_destroy();
    Router::redireccionar('index.php');
  }
}