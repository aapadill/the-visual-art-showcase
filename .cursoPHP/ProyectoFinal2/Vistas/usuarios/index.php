<?php 
require_once('../../config/cargador.php');
use Modelos\Usuario;
use Controladores\Router;


//Listado Usuarios
$resultados = Usuario::listar();

include Router::direccion('plantillas/header.php');
?>
<main>
<div class="container">
  <br>
    <h4>Administrar Direcciones</h4>
    <a href="editar.php" class="btn btn-info">Agregar usuario</a>
  <br>
  <br>

  <table class="table table-hover">
    <thead class="table-dark">
      <tr>
        <th>Editar</th>
        <th>Id</th>
        <th>Imagen</th>
        <th>Nombre de Usuario</th>
        <th>Email</th>
        <th>Nombre</th>
        <th>Rol</th>
        <th>Eliminar</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($resultados as $renglon) :
      ?>
        <tr>        
          <td>
            <form action="editar.php" method="GET" class="form">
              <input type="hidden" name="usuario_id" value="<?php echo $renglon['usuario_id'];?>">
              <input type="submit" value="Editar" class="btn btn-primary">
            </form>
          </td>
          <td><?php echo $renglon['usuario_id']; ?></td>
          <td><img class="img-thumbnail" width="70px" src="../../img/usuarios/user.png" alt="Img"></td>
          <td><?php echo $renglon['nombre_usuario']; ?></td>
          <td><?php echo $renglon['email']; ?></td>
          <td><?php echo $renglon['nombre']; ?></td>
          <td>
              <?php echo $renglon['rol_nombre']; ?>
              <form action="promover.php" method="POST" class="form">
                <input type="hidden" name="usuario_id" value="<?php echo $renglon['usuario_id'];?>">
                <input type="hidden" name="rol_id" value="<?php echo $renglon['rol_id'];?>">
                <input type="submit" value="Promover" class="btn btn-primary pull-right">
              </form>

          </td>
          <td><form action="index.php" method="POST" class="form">
            <input type="hidden" name="usuario_id" value="<?php echo $renglon['usuario_id']; ?>">
            <input type="submit" value="Eliminar" class="btn btn-danger">
          </form></td>
        </tr>
      <?php
        endforeach;
        ?>
    </tbody>
  </table>
</div> 
</main> 

<?php
include('../plantillas/footer.php');
?>