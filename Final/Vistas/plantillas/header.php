<?php
use Controladores\Router;
use Controladores\Sesion;
use Modelos\Conexion;

$sesion = new Sesion(); //la sesion la manejara el header

$usuarioSesion = $sesion->obtener('usuario') ?? [];
// $productosSesion = $sesion->obtener('productos') ?? [];

$nombreSesion = $usuarioSesion->username ?? '';
$rolSesion = $usuarioSesion->roleID ?? '';
$usuarioIdSesion = $usuarioSesion->userID ?? 0;

$subscribed = 0; //hardcored, properly bring a table, or column?
$submitted = 0; //hardcored, properly bring from table

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
    <title> Proyecto </title>
    <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('bootstrap5/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php Router::rutaRecursoWeb('main.css');?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="<?php Router::rutaRecursoWeb('css/style.css');?>" rel="stylesheet"/>
  </head>
    
  <body>
    <header class="main-header">
      <!-- left menu: register/suscribe/submit -->
      <nav class="corner center-left navbar navbar-expand-lg"> <!-- navbar sticky-top navbar-expand-lg navbar-dark bg-dark -->
          <ul class="menu" id="register-subscribe-submit">
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
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?php echo $nombreSesion;?> </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                  if ($rolSesion == '1' || $rolSesion == '2' ){ //user or admin
                  ?>
                    <li> <b> User Menu <b> </li>          
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('usuarios/');?>">Admin Profile</a></li>
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('likes/');?>">Likes</a></li>
                  <?php
                  }

                  if ($rolSesion == '2'){ //artist
                  ?> 
                    <li> <b> Artist Menu <b> </li>
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('artists/');?>">Admin Artist Profile</a></li>
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('artworks/');?>">Admin Artworks</a></li>
                  <?php
                  }

                  if ($rolSesion == '3'){ //admin
                  ?>
                    <li> <b> Admin Menu <b> </li>    
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('weeklyShowcase/');?>">Admin Weekly Showcases</a></li>
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('showcaseArtworks/');?>">Admin Showcase Artworks</a></li>
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('artworks/');?>">Admin Artworks</a></li>
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('artists/');?>">Admin Artists</a></li>
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('usuarios/');?>">Admin Usuarios</a></li>
                  <?php
                  }

                  if ($rolSesion){ //admin, artist, user, 123
                  ?>
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('cerrarSesion.php');?>">Cerrar sesion</a></li>
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
                  <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Subscription </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('artists/');?>">Admin Subscription</a></li>
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
                  <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Submission </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php Router::direccionWeb('submissions/');?>">Admin Submission</a></li>
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
      <nav class="corner center-right" id="archives-about-language">
          <ul class="menu">
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