<?php
session_start();
$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

$nombre = $_SESSION['usuario'] ?? $_POST['usuario'] ?? '';


if ($method == 'GET') {
    if (validarSesion()) {
        if (isset($_GET['salir'])) {
            cerrarSesion();
            require __DIR__ . '/login.php';
        } else {
            require __DIR__ . '/bienvenida.php';
        }
    } else {
        require __DIR__ . '/login.php';
    }
} else {
    if (isset($_POST['usuario'])) {
        if (validarLogin()) {
            $nombre = $_SESSION['usuario'];
            require __DIR__ . '/bienvenida.php';
        } else {
            require __DIR__ . '/login.php';
        }
    }
    if (isset($_POST['actualiza'])) {
        mantenerAbierta();
        echo '{"test" : 1}';
    }
}

function validarLogin() {
    $nombre = htmlentities($_POST['usuario'] ?? '');
    $password = htmlentities($_POST['password'] ?? '');

    $res = !empty($nombre) && !empty($password);
    
    if ($res) {
        $_SESSION['usuario'] = $nombre;
    }
    return $res;
}

function validarSesion() {
    return isset($_SESSION['usuario']);
}

function cerrarSesion() {
    session_destroy();
}

function mantenerAbierta() {
    if (validarSesion()) {
        $_SESSION['usuario'] = $_SESSION['usuario']; 
    }
}