<?php
session_start();

$metodo = $_SERVER['REQUEST_METHOD'];
$file = $_SERVER['PHP_SELF'];


if ($metodo == 'GET') {
	// Inicia token
	$_SESSION['token'] = bin2hex(random_bytes(35));
	// Carga Formulario
	require 'RegistroUsuario.php';
} else {
	// Procesa formulario
	require 'PerfilUsuario.php';
}

?>