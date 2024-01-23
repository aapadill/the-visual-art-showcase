<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

  <!-- index --> <!-- index --> <!-- index -->  <!-- index --> 
  for para la coincidencia, por default se muestran todos los productos
  <?php
    foreach($productos as $producto) {
      $nuevaCantidad = htmlentities($productosSesion[$producto['producto_id']]['cantidad'] ?? '0');
  ?>
    <!-- n producto -->
    <div class="col">
      <div class="card">
        <!-- imagen -->
        <img src="<?php Router::rutaImagenWeb($producto['img_producto'])?>" class="card-img-top" alt="...">
        <!-- info -->
        <div class="card-body" id="producto-1">
          <!-- precio + nombre -->
          <h5 class="card-title">
            <?php echo $producto['nombre'];?>
            <br>
            <span>
              $<?php echo $producto['precio']; ?>
            </span>
          </h5>
          <!-- descripcion -->
          <p class="card-text"><?php echo $producto['descripcion']; ?></p>
          
          <!-- cada producto tiene un formulario POST, 4.a.i) agregar.php -->
          <form action="./carritoCompra/agregar.php" class="agregar form-inline" method="POST">
            <div class="input-group">
              <!-- 4.b.iii) elementos del POST -->
              <input type="hidden" name="producto_id" value="<?php echo $producto['producto_id']; ?>">
              <input type="hidden" name="nombre" value="<?php echo $producto['nombre']; ?>"> <!-- nombre -->
              <input type="hidden" name="imagen" value="<?php Router::rutaImagenWeb($producto['img_producto']) ?>"> <!-- imagen -->
              <input type="hidden" name="precio_final" value="<?php echo $producto['precio']; ?>">
              <input type="number" class="form-control" value="<?php echo $nuevaCantidad; ?>" min="0" max="10" name="cantidad">
              <!-- boton -->
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Agregar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php
    }
  ?>

<p> from <?php echo $weeklyShowcase->weekStartDate;?> to <?php echo $weeklyShowcase->weekEndDate;?> </p>

<?php
// echo '<pre>';
// $sesion = $sesion->getSesion() ?? [];

// $usuarioSesion = $sesion['usuario'] ?? [];
// var_dump($usuarioSesion);
// var_dump($rolSesion);
// var_dump($_SESSION);
// var_dump($nombreSesion);

// var_dump($filteredDayIDs);

// var_dump();
// echo '<pre>';
// var_dump($weekArtist);

// var_dump($techniqueSelected);

//aqui andaba el Router::direccion

?>
<!-- class="row row-cols-md-3" id="productos" -->

<header class="main-header">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <!-- left menu: register/suscribe/submit -->
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
        </div>
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


    <!-- header aux bootstrap -->
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container">
              <!-- Left Nav -->
              <div class="navbar-left">
                  <ul class="navbar-nav">
                      <?php if (empty($usuarioSesion)) { //sesion no iniciada ?>
                          <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('login.php'); ?>">Login</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('subscribe.php'); ?>">Subscribe</a></li>
                          <li class="nav-item"><a class="nav-link" href="<?php Router::direccionWeb('submit.php'); ?>">Submit</a></li>
                      <?php } ?>

                      <?php if (!empty($usuarioSesion)) { //sesion iniciada ?>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown"><?php echo $nombreSesion; ?></a>
                              <div class="dropdown-menu" aria-labelledby="userDropdown">
                                  
                                  <?php include 'dynamic_user_menu.php'; // Separate PHP file for user menu logic ?>
                              </div>
                          </li>
                      <?php } ?>
                  </ul>
              </div>

              <!-- Center Logo -->
              <div class="navbar-center">
                  <a class="navbar-brand" href="<?php Router::direccionWeb('index.php'); ?>">
                      <img src="logo.png" alt="Logo">
                  </a>
              </div>

              <!-- Right Nav -->
              <div class="navbar-right">
                  <ul class="navbar-nav">
                      <li class="nav-item"><a class="nav-link" href="/archives">Archives</a></li>
                      <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="languagesDropdown" data-toggle="dropdown">Languages</a>
                          <div class="dropdown-menu" aria-labelledby="languagesDropdown">
                              <!-- Language Options -->
                              <a class="dropdown-item" href="#">EN</a>
                              <a class="dropdown-item" href="#">ES</a>
                              <a class="dropdown-item" href="#">FI</a>
                              <a class="dropdown-item" href="#">SV</a>
                          </div>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
  </header>