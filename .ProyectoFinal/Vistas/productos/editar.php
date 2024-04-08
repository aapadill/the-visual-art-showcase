<?php
require_once('../../config/cargador.php');
use Controladores\Router;
use Modelos\Producto;
use Modelos\Usuario;

include Router::direccion('plantillas/header.php');

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
$usuarios = Usuario::getUserByRolId(2); //arreglo, regresa todos los usuarios tipo vendedor

//viene de editar
if ($existeGET) { //7.b.d) GET
  // var_dump($_GET);
  $productoId = $_GET['producto_id'];
  $producto = new Producto();
  $p = $producto->consultar($productoId);
  // var_dump($usuarios);
  // foreach ($usuarios as $u){
  //   echo '<pre>';
  //   var_dump($u);
?>
  <form class="form-horizontal" action="guardar.php" method="POST" enctype="multipart/form-data">
    <?php
    if ($rolSesion = '2'){ //si eres vendedor editas tu propio producto
    ?>
      <input type="hidden" name="vendedor_id" value="<?php echo $usuarioIdSesion ?>">
    <?php
    }
    ?>

    <input type="hidden" name="producto_id" value="<?php echo $p->productoId ?>">

    <div class="form-group">
      <label  class="col-md-8 offset-md-2" for="nombre">Nombre:</label>
      <div  class="col-md-8 offset-md-2">
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $p->nombre ?>">
      </div>
    </div>
    <br>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="descripcion">Descripcion:</label>
      <div class="col-md-8 offset-md-2">
        <textarea name="descripcion" class="form-control" rows="5" value="<?php echo $p->descripcion ?>"></textarea>
      </div>
    </div>
    <br>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="precio">Precio:</label>
      <div class="col-md-8 offset-md-2">
        <input type="number" min="1" class="form-control" name="precio" value="<?php echo $p->precio ?>">
      </div>
    </div>
    <br>

    <!-- ???este pa que es??? -->
    <!-- <div class="form-group">
      <label class="col-md-8 offset-md-2" for="vendedorr_id">Vendedor:</label>
      <div class="col-md-8 offset-md-2">
        <select name="rol_id" class="form-control" value="<?php echo $p->vendedorId ?>">
          <option value="<?php echo $p->vendedorId ?>"><?php echo $p->vendedorId ?></option>
          <option value="2">vendedor</option>
          <option value="3">vendedor</option>
        </select>
      </div>
    </div>
    <br> -->

    <?php
    if ($rolSesion = '1'){ //si eres admin puedes seleccionar de los vendedores disponibles
    ?>
      <!-- seleccionador de vendedor -->
      <div class="form-group">
        <label class="col-md-8 offset-md-2" for="vendedorr_id">Vendedor:</label>
        <div class="col-md-8 offset-md-2">
          <select name="vendedor_id" class="form-control" value="">
            <?php
            foreach ($usuarios as $u) {
            ?>
              <option value="<?php echo $u['usuario_id'] ?>"><?php echo $u['nombre_usuario'] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
      </div>
    <?php
    }
    ?>

    <div class="form-group">
      <label class="col-md-8 offset-md-2" for="imagen_archivo">Imagen:</label>
      <input type="hidden" name="img_producto" value="<?php echo $p->imgProducto ?>">
      <div class="col-md-8 offset-md-2">
        <input type="file" class="form-control" name="imagen_archivo">
      </div>
    </div>
    
    <br>
    <div class="col-md-3 offset-md-6">
      <button type="submit" class="btn btn-primary pull-right">Guardar</button>
      <a href="index.php" class="btn btn-secondary pull-right">Cancelar</a> 
    </div>
  </form>

<?php
}

//viene de 'agregar producto', por lo que se espera un producto nuevo, si es admin le sale un seleccionador de vendedores, si es un vendedor no le sale el seleccionador y se manda su $usuarioIdSesion
else{
    ?>
    <form class="form-horizontal" action="guardar.php" method="POST" enctype="multipart/form-data">
      <?php
        if ($rolSesion = '2'){ //si eres vendedor editas tu propio producto
      ?>
        <input type="hidden" name="vendedor_id" value="<?php echo $usuarioIdSesion ?>">
      <?php
        }
      ?>

        <input type="hidden" name="producto_id" value="n">

        <div class="form-group">
          <label  class="col-md-8 offset-md-2" for="nombre">Nombre:</label>
          <div  class="col-md-8 offset-md-2">
            <input type="text" class="form-control" id="nombre" name="nombre" value="">
          </div>
        </div>
        <br>

        <div class="form-group">
          <label class="col-md-8 offset-md-2" for="descripcion">Descripcion:</label>
          <div class="col-md-8 offset-md-2">
            <textarea name="descripcion" class="form-control" rows="5" value=""></textarea>
          </div>
        </div>
        <br>

        <div class="form-group">
          <label class="col-md-8 offset-md-2" for="precio">Precio:</label>
          <div class="col-md-8 offset-md-2">
            <input type="number" min="1" class="form-control" name="precio" value="">
          </div>
        </div>
        <br>

      <?php

        if ($rolSesion = '1'){ //si eres admin puedes seleccionar de los vendedores disponibles
      ?>
          <!-- seleccionador de vendedor -->
          <div class="form-group">
            <label class="col-md-8 offset-md-2" for="vendedorr_id">Vendedor:</label>
            <div class="col-md-8 offset-md-2">
              <select name="vendedor_id" class="form-control" value="">
                <?php
                foreach ($usuarios as $u) {
                ?>
                  <option value="<?php echo $u['usuario_id'] ?>"><?php echo $u['nombre_usuario'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
      <?php
        }
      ?>

        <br>
        <div class="form-group">
          <label class="col-md-8 offset-md-2" for="imagen_archivo">Imagen:</label>
          <input type="hidden" name="img_producto" value="">
          <div class="col-md-8 offset-md-2">
            <input type="file" class="form-control" name="imagen_archivo">
          </div>
        </div>
        
        <br>
        <div class="col-md-3 offset-md-6">
          <button type="submit" class="btn btn-primary pull-right">Guardar</button>
          <a href="index.php" class="btn btn-secondary pull-right">Cancelar</a>
        </div>
    <?php
  }
  include Router::direccion('/plantillas/footer.php');
?>