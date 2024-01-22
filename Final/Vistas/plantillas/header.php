<?php
use Controladores\Router;
use Controladores\Sesion;
use Modelos\Conexion;

$sesion = new Sesion(); //la sesion la manejaremos aqui en el header

$usuarioSesion = $sesion->obtener('usuario') ?? [];
$nombreSesion = $usuarioSesion->username ?? '';
$rolSesion = $usuarioSesion->roleID ?? '';
$usuarioIdSesion = $usuarioSesion->userID ?? 0;
$subscribed = 0; //hardcored, properly bring a table, or column?
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
    <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('main.css');?>">
    <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('css/style.css');?>">
  </head>
    
  <body>
    <header>
      <!-- left menu: register/suscribe/submit -->
      <nav>
        <ul>
          <?php
            if (empty($usuarioSesion)){ //sesion no iniciada
          ?>
            <li> <a href="<?php Router::direccionWeb('login.php');?>"> <b> LOG IN </b> </a> </li>
            <li> <a href="<?php Router::direccionWeb('subscribe.php');?>"> <b> SUBSCRIBE </b> </a> </li>
            <li> ARTIST?<a href="<?php Router::direccionWeb('submit.php');?>"> <b> SUBMIT </b> </a> </li>
          <?php
            }
            if (!empty($usuarioSesion)){ //sesion iniciada
          ?>
            <li>
              <a> <?php echo $nombreSesion;?> </a>
              <ul>
                <?php
                if ($rolSesion == '1' || $rolSesion == '2' ){ //user or admin
                ?>
                  <h6 class="dropdown-header">User options</h6>
                  <li><a href="<?php Router::direccionWeb('usuarios/');?>">Admin Profile</a></li>
                  <li><a href="<?php Router::direccionWeb('likes/');?>">Likes</a></li>
                <?php
                }

                if ($rolSesion == '2'){ //artist
                ?> 
                  <div></div>
                  <h6 class="dropdown-header">Artist options</h6>
                  <li><a href="<?php Router::direccionWeb('artists/');?>">Admin Artist Profile</a></li>
                  <li><a href="<?php Router::direccionWeb('artworks/');?>">Admin Artworks</a></li>
                <?php
                }

                if ($rolSesion == '3'){ //admin
                ?>
                  <h6 class="dropdown-header">Administrator options</h6> 
                  <li><a href="<?php Router::direccionWeb('weeklyShowcase/');?>">Admin Weekly Showcases</a></li>
                  <li><a href="<?php Router::direccionWeb('showcaseArtworks/');?>">Admin Showcase Artworks</a></li>
                  <li><a href="<?php Router::direccionWeb('artworks/');?>">Admin Artworks</a></li>
                  <li><a href="<?php Router::direccionWeb('artists/');?>">Admin Artists</a></li>
                  <li><a href="<?php Router::direccionWeb('usuarios/');?>">Admin Usuarios</a></li>
                <?php
                }

                if ($rolSesion){ //admin, artist, user, 123
                ?>
                  <li><a href="<?php Router::direccionWeb('cerrarSesion.php');?>">Cerrar sesion</a></li>
                <?php
                }

                else{ //de alguna manera traes sesion sin rol?, matamos la sesion Xd
                  $sesion.cerrarSesion();
                }
                ?>
              </ul>
            </li>
          <?php
              //not subscribed
              if ($subscribed == 0 && ($rolSesion == '2' || $rolSesion == '1')){ //admin should not get any option
          ?>
                <li> <a href="<?php Router::direccionWeb('subscribe.php');?>"> <b> SUBSCRIBE! </b> </a> </li>
          <?php
              }
              //subscribed
              if ($subscribed == 1 && ($rolSesion == '2' || $rolSesion == '1')){ //admin should not get any option
          ?>
                <li>
                <a> Subscription </a>
                <ul>
                  <li> <a href="<?php Router::direccionWeb('artists/');?>">Admin Subscription</a></li>
                </ul>
          <?php
              }
              //not submitted
              if ($submitted == 0 && ($rolSesion == '2' || $rolSesion == '1')){
                if ($rolSesion == '1'){
          ?>
              <li> ARTIST? <a href="<?php Router::direccionWeb('submit.php');?>"> <b> SUBMIT! </b> </a> </li>
          <?php
                }
                if ($rolSesion == '2'){
          ?>
                <li> <a href="<?php Router::direccionWeb('submit.php');?>"> <b> SUBMIT? </b> </a> </li>
          <?php
                }
              }
              //submitted
              if ($submitted == 1 && $rolSesion == '2'){
          ?>
                <li>
                <a> Submission </a>
                <ul>
                  <li><a href="<?php Router::direccionWeb('submissions/');?>">Admin Submission</a></li>
                </ul>
          <?php
              }
            }
          ?>
        </ul>
      </nav>

      <!-- logo -->
      <div class="logo">
          <a href="<?php Router::direccionWeb('index.php');?>">
              <p> 
                  the<br>
                  visual<br>
                  art<br>
                  showcase<br>
              </p>
          </a>
      </div>
      
      <!-- right menu: archives/about/language -->
      <nav>
          <ul>
              <li> <a href="/archives"> <b> ARCHIVES </b> </a></li>
              <li> <a href="/about"> <b> ABOUT </b> </a></li>
              <li> 
                  <select name="language-select" id="language-select">
                      <option value="en"> EN </option>
                      <option value="es"> ES </option>
                      <option value="fi"> FI </option>
                      <option value="sv"> SV </option>
                  </select> 
              </li>
          </ul>
      </nav>
    </header>
  
    <main>
      <div class="container">
      <br>