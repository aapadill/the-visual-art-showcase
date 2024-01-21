<!-- dependiendo del rol del usuario (default, comprador, vendedor, admin) presentar diferentes menus -->
<?php
use Controladores\Router;
use Controladores\Sesion;
use Modelos\Conexion;

$sesion = new Sesion(); //la sesion la manejara el header

$usuarioSesion = $sesion->obtener('usuario') ?? [];
$productosSesion = $sesion->obtener('productos') ?? [];

$nombreSesion = $usuarioSesion->nombreUsuario ?? '';
$rolSesion = $usuarioSesion->rolId ?? '';
$usuarioIdSesion = $usuarioSesion->usuarioId ?? 0;

// echo '<pre>';
// $sesion = $sesion->getSesion() ?? [];
// $usuarioSesion = $sesion['usuario'] ?? [];
// var_dump($usuarioSesion);
// var_dump($rolSesion);
// var_dump($_SESSION);
// var_dump($nombreSesion);
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
      <!-- cambio redireccion de click a logo -> index -->
      <a class="navbar-brand" href="<?php Router::direccionWeb('index.php');?>">HOME</a> 

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Navegacion">
        <span class="navbar-toggler-icon"></span>
      </button

      <div class="input-group">
        <!-- 3.a.ii) barra busqueda -->
        <form class="d-flex" action="<?php Router::direccionWeb('index.php'); ?>" method="GET">
          <input type="text" class="form-control" placeholder="Buscar" id="texto_buscar" name="buscar"> 
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" id="buscar">Buscar</button>
          </div>
        </form>
      </div>
      
      <!-- 3.a.i) mostrar menu -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php
          if (empty($usuarioSesion)){ //si usuario no existe en sesion (sesion no iniciada)
          ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php Router::direccionWeb('login.php');?>">Iniciar sesión</a> <!-- 3.a.i) 4.b) -->
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?php Router::direccionWeb('registrar.php');?>">Registrarse</a> <!-- 3.a.i) 4.c) -->
            </li>
          <?php
          }

          if (!empty($usuarioSesion)){ //si usuario existe en sesion (sesion iniciada)
          ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $nombreSesion;?> </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php
                if ($rolSesion == '1'){ //3.bc) admin
                ?>          
                  <li><a class="dropdown-item" href="<?php Router::direccionWeb('usuarios/');?>">Admin Usuarios</a></li>
                  <!-- administrar tipo de productos -->
                <?php
                }

                if ($rolSesion == '1' || $rolSesion == '2'){ //2.b) 3.a) admin, vendedor
                ?> 
                  <li><a class="dropdown-item" href="<?php Router::direccionWeb('productos/');?>">Admin Productos</a></li>
                <?php
                }

                if ($rolSesion == '1' || $rolSesion == '2' || $rolSesion == '3'){ //1.bcd) 2.a) 3.a) admin, vendedor, comprador
                ?>
                  <li><a class="dropdown-item" href="<?php Router::direccionWeb('direcciones/');?>">Admin Direcciones</a></li>
                  <li><a class="dropdown-item" href="<?php Router::direccionWeb('ordenes/');?>">Admin Ordenes</a></li>
                  <li><a class="dropdown-item" href="<?php Router::direccionWeb('cerrarSesion.php');?>">Cerrar sesion</a></li>
                <?php
                }

                if ($rolSesion){ //1.bcd) 2.a) 3.a) admin, vendedor, comprador
                  ?>
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('cerrarSesion.php');?>">Cerrar sesion</a></li>
                  <?php
                }

                else{ //de alguna manera traes sesion sin rol?, matamos la sesion Xd
                  session_destroy();
                }
                ?>
              </ul>
            </li>

          <?php
            }
          ?>

          <!-- 3.a.i) 4.a) carrito para todos -->
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
