<?php
session_start();
$metodo = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

if ($metodo !== 'POST') {
	header('Location: registro.php');
}

// Validar Dator
$datosInvalidos = empty($nombre) || empty($nombreUsuario) || empty($password) || empty($email);

if ($datosInvalidos) {
    // Regresar datos al formulario
    $usuario = [];
    $usuario['usuario_id'] = $usuarioId;
    $usuario['nombre'] = $nombre;
    $usuario['nombre_usuario'] = $nombreUsuario;
    $usuario['password'] = $password;
    $usuario['email'] = $email;
    $_SESSION['usuario'] = $usuario;

    $usuarioEdit = empty($usuarioId) ? '' : "?usuario_id=$usuarioId";
    header("Location: registro.php$usuarioEdit");
}

// Guarda usuario
header('usuarios.php');