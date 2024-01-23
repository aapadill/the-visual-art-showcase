<?php
use Controladores\Router;
use Controladores\Sesion;
use Modelos\Conexion;

$sesion = new Sesion(); //la sesion la manejaremos aqui en el header

$usuarioSesion = $sesion->obtener('usuario') ?? [];
$nombreSesion = $usuarioSesion->username ?? '';
$rolSesion = $usuarioSesion->roleID ?? '';
$usuarioIdSesion = $usuarioSesion->userID ?? 0;
$subscribed = 1; //hardcored, properly bring a table, or column?
$submitted = 1; //hardcored, properly bring from table
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Proyecto </title>
    <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('bootstrap5/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('main.css');?>">
    <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('css/style.css');?>">
  </head>

  <body>
      <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <!-- Navbar Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Nav -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php 
                        if (empty($usuarioSesion)){  
                        ?>
                            <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('login.php'); ?>">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('subscribe.php'); ?>">Subscribe</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submit.php'); ?>">Submit</a></li>
                        <?php 
                        } 
                        ?>
                        <?php
                        if (!empty($usuarioSesion)){
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $nombreSesion; ?> </a>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <?php
                                    if ($rolSesion == '1' || $rolSesion == '2' ){
                                    ?>
                                        <h6 class="dropdown-header">User options</h6>
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('usuarios/');?>">Admin Profile</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('likes/');?>">Likes</a></li>
                                    <?php
                                    }
                                    if ($rolSesion == '2'){
                                    ?> 
                                        <h6 class="dropdown-header">Artist options</h6>
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artists/');?>">Admin Artist Profile</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artworks/');?>">Admin Artworks</a></li>
                                    <?php
                                    }
                                    if ($rolSesion == '3'){ 
                                    ?>
                                        <h6 class="dropdown-header">Administrator options</h6> 
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('weeklyShowcase/');?>">Admin Weekly Showcases</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('showcaseArtworks/');?>">Admin Showcase Artworks</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artworks/');?>">Admin Artworks</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artists/');?>">Admin Artists</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('usuarios/');?>">Admin Usuarios</a></li>
                                    <?php
                                    }
                                    if ($rolSesion){
                                    ?>
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('cerrarSesion.php');?>">Cerrar sesion</a></li>
                                    <?php
                                    }
                                    else{ 
                                        $sesion.cerrarSesion();
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                            if ($subscribed == 0 && ($rolSesion == '2' || $rolSesion == '1')){
                            ?>
                                <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('subscribe.php');?>"> <b> SUBSCRIBE! </b> </a> </li>
                            <?php
                            }
                            if ($subscribed == 1 && ($rolSesion == '2' || $rolSesion == '1')){
                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Subscription </a>
                                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artists/');?>">Admin Subscription</a></li>
                                    </ul>
                                </li>
                            <?php
                            }
                            if ($submitted == 0 && ($rolSesion == '2' || $rolSesion == '1')){
                                if ($rolSesion == '1'){
                            ?>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submit.php');?>"> <b> SUBMIT! </b> </a> </li>
                            <?php
                                }
                                if ($rolSesion == '2'){
                            ?>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submit.php');?>"> <b> SUBMIT? </b> </a> </li>
                            <?php
                                }
                            }
                            if ($submitted == 1 && $rolSesion == '2'){
                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Submission </a>
                                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submissions/');?>">Admin Submission</a></li>
                                    </ul>
                                </li>
                            <?php
                            }
                        }
                        ?>
                    </ul>

                    <!-- Centered logo -->
                    <div class="navbar-center logo">
                        <a class="navbar-brand" href="<?php Router::direccionWeb('index.php');?>">
                            <p> the visual art showcase </p>
                        </a>
                    </div>

                    <!-- Right Nav -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="/archives">Archives</a></li>
                        <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="languagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Languages
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="languagesDropdown">
                                <li><a class="dropdown-item" href="#">EN</a></li>
                                <li><a class="dropdown-item" href="#">ES</a></li>
                                <li><a class="dropdown-item" href="#">FI</a></li>
                                <li><a class="dropdown-item" href="#">SV</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
      </header>
    <main>
      <div class="container">
      <br>