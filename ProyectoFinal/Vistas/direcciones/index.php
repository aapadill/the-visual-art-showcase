<?php
include_once '../../config/cargador.php';

use Controladores\Router;
use Modelos\Direccion; // 7.a.i.1) incluir Modelos/Direccion

include Router::direccion('plantillas/header.php');
// debug
// echo '<pre>';
// var_dump($usuarioIdSesion);

$direccion = [];

// 7.a.i.2 Mostrar diferentes direcciones dependiendo de rolSesion
if ($rolSesion == '1'){
  $direccion = Direccion::listarAdmin();
}

if ($rolSesion == '2' || $rolSesion == '3'){
  $direccion = Direccion::listar($usuarioIdSesion);
}

// debug
// foreach ($direccion as $d) {
//   var_dump($d);
// }
?>
  <h4>Administrar Direcciones</h4>
  <!-- botonAgregar direccion -->
  <a href="editar.php" class="btn btn-info">Agregar dirección</a>
  <br>
  <br>
  <table class="table table-hover">
    <!-- cabecera tabla -->
    <thead class="table-dark">
      <tr>
        <th>Editar</th>
        <th>ID</th>
        <th>Nombre</th>
        <th>Calle #</th>
        <th>CP</th>
        <th>Colonia</th>
        <th>Municipio</th>
        <th>Estado</th>
        <?php
          if ($rolSesion == '1'){
        ?>
          <th>userID</th>
          <th>Username</th>
        <?php
          }
        ?>
        <th>Borrar</th>
      </tr>
    </thead>
    <!-- direcciones -->
    <?php
    foreach ($direccion as $d) {
    ?>
    <tbody>
      <tr>
        <td>
          <!-- boton Editar -->
          <form action="editar.php" method="GET" class="form">
            <input type="hidden" name="direccion_id" value="<?php echo $d['direccion_id'];?>">
            <input type="submit" value="Editar" class="btn btn-primary">
          </form>
        </td>
        <td><?php echo $d['direccion_id']; ?></td>
        <td><?php echo $d['nombre']; ?></td>
        <td><?php echo $d['calle_numero']; ?></td>
        <td><?php echo $d['cp']; ?></td>
        <td><?php echo $d['colonia']; ?></td>
        <td><?php echo $d['municipio']; ?></td>
        <td><?php echo $d['estado']; ?></td>
        <?php
          if ($rolSesion == '1'){
        ?>
          <td><?php echo $d['usuario_id']; ?></td>
          <td><?php echo $d['nombre_usuario']; ?></td>
        <?php
          }
        ?>
        <td>
          <!-- boton Eliminar -->
          <form action="eliminar.php" method="POST" class="form">
            <input type="hidden" name="direccion_id" value="<?php echo $d['direccion_id'];?>">
            <input type="submit" value="Eliminar" class="btn btn-danger">
          </form>
        </td>
      </tr>
    </tbody>
    <?php
    }
    ?>
  </table>
<?php
include Router::direccion('plantillas/footer.php');