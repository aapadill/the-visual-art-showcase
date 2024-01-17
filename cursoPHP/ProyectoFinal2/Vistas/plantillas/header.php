<?php
use Controladores\Router;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda Online</title>
  <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('bootstrap5/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('main.css');?>">
</head>
<body>

<header>
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">TOnLin</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Navegacion">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="input-group">
        <form class="d-flex" action="<?php Router::direccionWeb('index.php'); ?>" method="GET">
          <input type="text" class="form-control" placeholder="Buscar" id="texto_buscar" name="buscar">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" id="buscar">Buscar</button>
          </div>
        </form>
      </div>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="<?php Router::direccionWeb('login.php');?>">Iniciar sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php Router::direccionWeb('registrar.php');?>">Registrarse</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Usuario
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?php Router::direccionWeb('direcciones/');?>">Admin Direcciones</a></li>
              <li><a class="dropdown-item" href="<?php Router::direccionWeb('ordenes/');?>">Admin Ordenes</a></li>
              <li><a class="dropdown-item" href="<?php Router::direccionWeb('productos/');?>">Admin Productos</a></li>
              <li><a class="dropdown-item" href="<?php Router::direccionWeb('usuarios/');?>">Admin Usuarios</a></li>
              <li><a class="dropdown-item" href="<?php Router::direccionWeb('cerrarSesion.php');?>">Cerrar sesion</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php Router::direccionWeb('/carritoCompra');?>">Ver Carrito</a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>
</header>
<main>
<div class="container">
  <br>
