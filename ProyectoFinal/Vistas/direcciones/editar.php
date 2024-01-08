<?php
include '../../config/cargador.php';
use Controladores\Router;
use Modelos\Direccion;

include Router::direccion('/plantillas/header.php');

//debug
// echo '<pre>';
// echo '$_POST: ';
// var_dump($_POST);

// echo '$_SESSION: ';
// var_dump($_SESSION);

// echo '$usuarioSesion: ';
// var_dump($usuarioSesion);

// echo $usuarioIdSesion;

$existeGET = !empty($_GET);

//viene de editar
if ($existeGET) { //7.b.d) GET
  //var_dump($_GET);
  $direccionId = $_GET['direccion_id'];
  $direccion = new Direccion();
  $d = $direccion->consultar($direccionId);
?>
  <div>
    <!-- POST, direcciona a guardar.php -->
    <form class="form" action="guardar.php" method="post" enctype="multipart/form-data">
      <?php
      if ($rolSesion != '1'){ //si no eres admin editas tu direccion
      ?>
        <input type="hidden" name="usuario_id" value="<?php echo $usuarioIdSesion ?>">
      <?php
      }
      if ($rolSesion = '1'){ //si eres admin te 'robas' la identidad del usuario y guardas como si fueras el
      ?>
        <input type="hidden" name="usuario_id" value="<?php echo $d->usuarioId ?>">
      <?php
      }
      ?>

      <input type="hidden" name="direccion_id" value="<?php echo $d->direccionId ?>">
      
      <div class="form-group">
        <label  class="col-md-8 offset-md-2" for="nombre">Nombre:</label>
        <div  class="col-md-8 offset-md-2">
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $d->nombre ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-8 offset-md-2" for="ap">Calle y numero:</label>
        <div class="col-md-8 offset-md-2">
          <input type="text" class="form-control" name="calle_numero" value="<?php echo $d->calleNumero ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-8 offset-md-2" for="am">CP:</label>
        <div class="col-md-8 offset-md-2">
          <input type="text" class="form-control" name="cp" value="<?php echo $d->cp ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-8 offset-md-2" for="correo">Colonia:</label>
        <div class="col-md-8 offset-md-2">
          <input type="text" class="form-control" name="colonia" value="<?php echo $d->colonia ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-8 offset-md-2" for="pwd">Municipio:</label>
        <div class="col-md-8 offset-md-2">
          <input type="text" class="form-control" name="municipio" value="<?php echo $d->municipio ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-8 offset-md-2" for="pwd">Estado:</label>
        <div class="col-md-8 offset-md-2">
          <input type="text" class="form-control" name="estado" value="<?php echo $d->estado ?>">
        </div>
      </div>
      <br>

      <div class="col-md-5 offset-md-5">
        <a href="index.php" class="btn btn-secondary pull-right">Cancelar</a>
        <button type="submit" class="btn btn-primary pull-right">Guardar</button>
      </div>
    </form>
  </div>
<?php
}

//viene de 'agregar direccion'
//auxiliar, se puede juntar con el form anterior
//necesita validaciones, vacio?, nombre de direccion existente?
else{
?>
  <form class="form" action="guardar.php" method="post" enctype="multipart/form-data">
    
    <!-- si admin, mostrar lista de usernames para seleccionar a quien se le asigna la direccion -->

    <input type="hidden" name="usuario_id" value="<?php echo $usuarioIdSesion ?>">

    <input type="hidden" name="direccion_id" value="n">

    <div class="form-group">
      <label  class="col-md-8 offset-md-2" for="nombre">Nombre:</label>
      <div  class="col-md-8 offset-md-2">
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="ap">Calle y numero:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="calle_numero">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="am">CP:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="cp">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="correo">Colonia:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="colonia">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="pwd">Municipio:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="municipio">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="pwd">Estado:</label>
      <div class="col-md-8 offset-md-2">
        <input type="text" class="form-control" name="estado">
      </div>
    </div>
    <br>

    <div class="col-md-5 offset-md-5">
      <a href="index.php" class="btn btn-secondary pull-right">Cancelar</a>
      <button type="submit" class="btn btn-primary pull-right">Guardar</button>
    </div>
  </form>
<?php
}
include Router::direccion('/plantillas/footer.php');
?>