<?php
$token = $_POST['token'] ?? '';
$tokenVericacion = $_SESSION['token'] ?? '';

if (empty($token) || $token !== $tokenVericacion) {
  header("Location: index.php");
}

$nombre = '';
if (isset($_POST['nombre'])) {
  $nombre = $_POST['nombre'];
}

$password = isset($_POST['password']) ? $_POST['password'] : '';

$sexo = $_POST['sexo'] ?? '';
$ocupacion = $_POST['ocupacion'] ?? '';
$perfil = $_POST['perfil'] ?? '';
$lenguajes = $_POST['lenguaje'] ?? [];

$titulo = 'Registro Perfil';

include __DIR__ . '/header.php';
?>
  <section>
    <h2>Información Personal</h2>
    <figure>
      <img alt="User Image" src="user.png" />
      <figcaption>Imagen Usuario</figcaption>
    </figure>
    <p>
        <b>Nombre :</b> <?php echo $nombre;?> <br>
        <b>Password :</b> <?php echo $password; ?><br>
        <b>Sexo :</b> <?php echo $sexo;?><br>
        <b>Ocupacion :<br></b> <?php echo $ocupacion ?><br>
    </p>
  </section>
  <section>
    <h2>Información General</h2>
    <b>Perfil :</b> <?php echo $perfil;?><br>
    <b>Lenguajes :</b><br> 
    <ul>
      <?php
      foreach($lenguajes as $valor) {
         echo "<li class='class'>$valor</li>";
     
      }
      ?>
    </ul>
    <br>
  </section>

<?php
include 'footer.html';
?>