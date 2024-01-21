<?php
namespace Controllers;
use Models\User;

class Session {
    public function __construct() {
        session_start();
    }

    public function getSesion() {
        return $_SESSION;
    }

    public function insert($key, $value){
        $_SESSION[$key] = $value;
    }

    public function get($key){
        $keys = explode('.', $key);
        $res = $_SESSION;

        $i = 0;
        while (isset($res) && $i < count($keys)) {
            $res = $res[$keys[$i]] ?? null;
            $i++;
        }
        return $res;
    }

    // public function insertarProducto($productoId, $producto, $cantidad) {
    // }

    public function validarLogin($usuario, $password) {
        $res = 'Invalid login';
        $validacion = false;
        $validacion = !empty($usuario) && !empty($password);
    
        // Redireccinamiento a index.php
        if ($validacion) {
            $usuarioBD = User::validarLogin($usuario, $password);
            if (!empty($usuarioBD['usuario_id'])) {
                $_SESSION['usuario'] = $usuarioBD;
                Router::redirectTo('index.php');
            } else {
                $res = $usuarioBD;
            }
        }
        return $res;
    }
  
    public function redirigirLogin() {
        if (empty($_SESSION['usuario'])) {
        Router::redirectTo('login.php');
        }
    }
  
    public function cerrarSesion() {
        unset($_SESSION['usuario']);
        session_destroy();
        Router::redirectTo('index.php');
    }
}