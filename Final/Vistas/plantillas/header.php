<?php
use Controladores\Router;
use Controladores\Sesion;
use Modelos\Conexion;

$sesion = new Sesion(); //la sesion la manejaremos aqui en el header

$usuarioSesion = $sesion->obtener('usuario') ?? [];

$nombreSesion = $usuarioSesion->username ?? '';
$rolSesion = $usuarioSesion->roleID ?? '';
$usuarioIdSesion = $usuarioSesion->userID ?? 0;
$subscribed = $usuarioSesion->isSubscribed ?? 0;
$likes = [];
// var_dump($sesion->getSesion());
$submitted = 0; //hardcored, properly bring from table
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Proyecto </title>
    <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('bootstrap5/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('css/style.css');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>

  <body>
    <header class="">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container d-flex justify-content-between justify-content-lg-center">
            <!-- Navbar Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Centered logo -->
            <div class="navbar-center logo">
                <a class="navbar-brand" href="<?php Router::direccionWeb('index.php');?>">
                    <p> the visual art showcase </p>
                </a>
            </div>

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
                                if ($rolSesion == '1' || $rolSesion == '2' || $rolSesion == '3'){
                                ?>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('users/index.php');?>">Edit profile</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('likes/editar.php');?>">Favorites</a></li>
                                <?php
                                }
                                if ($rolSesion == '2'){
                                ?> 
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artists/index-artist.php');?>">Edit artist profile</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artworks/index.php');?>">Edit your artworks</a></li>
                                <?php
                                }
                                if ($rolSesion == '3'){ 
                                ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('weeklyShowcase/');?>">Admin All Weekly Showcases</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('showcaseArtworks/');?>">Admin All Showcase Artworks</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artworks/');?>">Admin All Artworks</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artists/');?>">Admin All Artists</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('usuarios/');?>">Admin All Usuarios</a></li>
                                <?php
                                }
                                if ($rolSesion){
                                ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('cerrarSesion.php');?>">Log out</a></li>
                                <?php
                                }
                                //else{ 
                                  //  $sesion.cerrarSesion();
                                //}
                                ?>
                            </ul>
                        </li>
                        <?php
                        if ($subscribed == 0){ // && ($rolSesion == '2' || $rolSesion == '1')
                        ?>
                            <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('subscribe.php');?>"> Subscribe! </a> </li>
                        <?php
                        }
                        if ($subscribed == 1){ //&& ($rolSesion == '2' || $rolSesion == '1')
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Subscription </a>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('users/index.php?tab=subscription');?>">Admin Subscription</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        if ($submitted == 0){ //&& ($rolSesion == '2' || $rolSesion == '1')
                            if ($rolSesion == '1'){ //update account
                        ?>
                                <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submit.php');?>"> Submit! </a> </li>
                        <?php
                            }
                            if ($rolSesion == '2'){
                        ?>
                                <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submit.php');?>"> Submit? </a> </li>
                        <?php
                            }
                        }
                        if ($submitted == 1){ //&& $rolSesion == '2'
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Submission </a>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submit.php');?>">Admin Submission</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                    }
                    ?>
                </ul>
                <!-- Right Nav -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li><hr class="dropdown-divider"></li>
                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('archives.php');?>">Archives</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('about.php');?>">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Languages
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="languagesDropdown">
                            <li><a class="dropdown-item" href="#">EN (soon)</a></li>
                            <li><a class="dropdown-item" href="#">ES (soon)</a></li>
                            <li><a class="dropdown-item" href="#">FI (soon)</a></li>
                            <li><a class="dropdown-item" href="#">SV (soon)</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </header>

<main>
    <div class="container">