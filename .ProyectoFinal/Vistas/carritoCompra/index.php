<?php
require_once('../../config/cargador.php');
use Controladores\Router;

include Router::direccion('/plantillas/header.php');

//4.b.i) si no hay sesion iniciada redirigir a usuarioSinSesion
if(empty($usuarioSesion)){ //$_SESSION['usuario']
    $_SESSION['intento_compra'] = 1;
    include Router::direccion('carritoCompra/usuarioSinSesion.php');
}
//si hay sesion iniciada mostrar carrito
if(!empty($usuarioSesion)){
    //4.b.ii) si esta vacio el carrito
    if(empty($productosSesion)){ //$_SESSION['productos']
        include Router::direccion('/carritoCompra/carritoVacio.php');
    }
    //si no esta vacio el carrito, mostrarlo
    if(!empty($productosSesion)){
        include Router::direccion('/carritoCompra/verCarrito.php');
    }
}

include Router::direccion('/plantillas/footer.php');
?>