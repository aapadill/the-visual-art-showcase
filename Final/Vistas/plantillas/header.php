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
      <header class="sticky-top" >
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <!-- Left Nav -->
                <div class="navbar-left">
                  <ul class="navbar-nav">
                    <?php 
                    //sesion no iniciada
                    if (empty($usuarioSesion)){  
                    ?>
                      <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('login.php'); ?>">Login</a></li>
                      <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('subscribe.php'); ?>">Subscribe</a></li>
                      <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submit.php'); ?>">Submit</a></li>
                    <?php 
                    } 
                    ?>

                    <?php
                    //sesion iniciada 
                    if (!empty($usuarioSesion)){
                      ?>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $nombreSesion; ?> </a>
                          <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <?php
                            //user or admin
                            if ($rolSesion == '1' || $rolSesion == '2' ){
                            ?>
                              <h6 class="dropdown-header">User options</h6>
                              <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('usuarios/');?>">Admin Profile</a></li>
                              <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('likes/');?>">Likes</a></li>
                            <?php
                            }
                            //artist
                            if ($rolSesion == '2'){
                            ?> 
                              <h6 class="dropdown-header">Artist options</h6>
                              <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artists/');?>">Admin Artist Profile</a></li>
                              <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('artworks/');?>">Admin Artworks</a></li>
                            <?php
                            }
                            //admin
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
                            //admin, artist, user, 123
                            if ($rolSesion){
                            ?>
                              <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('cerrarSesion.php');?>">Cerrar sesion</a></li>
                            <?php
                            }
                            //de alguna manera traes sesion sin rol?, matamos la sesion Xd
                            else{ 
                              $sesion.cerrarSesion();
                            }
                            ?>
                          </ul>
                        </li>
                      <?php

                      //not subscribed
                      if ($subscribed == 0 && ($rolSesion == '2' || $rolSesion == '1')){
                      ?>
                        <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('subscribe.php');?>"> <b> SUBSCRIBE! </b> </a> </li>
                      <?php
                      }

                      //subscribed
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

                      //not submitted
                      if ($submitted == 0 && ($rolSesion == '2' || $rolSesion == '1')){
                        //and user
                        if ($rolSesion == '1'){
                      ?>
                          <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submit.php');?>"> <b> SUBMIT! </b> </a> </li>
                      <?php
                        }
                        //and artist
                        if ($rolSesion == '2'){
                      ?>
                          <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submit.php');?>"> <b> SUBMIT? </b> </a> </li>
                      <?php
                        }
                      }

                      //submitted, you gotta be an artist
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
                </div>

                <!-- centered logo -->
                <div class="navbar-center logo">
                    <a class="navbar-brand" href="<?php Router::direccionWeb('index.php');?>">
                      <!-- <img src="logo.png" alt="Logo"> -->
                      <p> 
                          the<br>
                          visual<br>
                          art<br>
                          showcase<br>
                      </p>
                    </a>
                </div>

                <!-- Right Nav -->
                <div class="navbar-right">
                    <ul class="navbar-nav">
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