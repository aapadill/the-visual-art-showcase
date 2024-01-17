<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
  <title>Registro Usuario Exitoso</title>
  <script>
    var url = "http://localhost/Dia4Practicas/sesion/";
    var refrescar =  () => {
      // Datos
      let postData = new FormData();
      postData.append('actualiza', '1')
      
      // Request
      let xhr = new XMLHttpRequest();
      xhr.open('POST', url, true);
      xhr.send(postData);

      // Callback carga
      xhr.onload = () => {
          console.log("Post request completada");
          console.log(xhr.response);
          setTimeout(refrescar, 1000);
      };
    };

    var salir =  () => {
      // Datos
      let postData = new FormData();
      postData.append('salir', '1')
      
      // Request
      let xhr = new XMLHttpRequest();
      xhr.open('GET', url + 'index.php?salir=1', true);
      xhr.send();

      // Callback carga
      xhr.onload = () => {
          console.log("Get request completado");
          // Recargar Index para regresar al login
          window.location.href = url;
      };
    };

    var cerrarSesion = () => {
      if (!confirm('Deseas seguir conectado')) {
        salir();
      }
      setTimeout(cerrarSesion, 10000);
    };

    var loopPrincipal = () => {
      setTimeout(cerrarSesion, 10000);
      setTimeout(refrescar, 10000);
    };

    // Asignar loop principal
    window.onload = loopPrincipal;
  </script>
</head>
<body>
<header><h1>Bienvenido RedPost <?php echo $nombre;?></h1></header>
<main>
  <section>
    <h2>Bienvenido</h2>
    <p>
      Usuario : <b><?php echo $nombre;?></b>
    </p>
  </section>
  <section>
    <h2>Cerrar sesión</h2>
    <form action="index.php">
      <input type="hidden" name="salir" value="1">
      <input type="submit" value="Salir">
    </form>
  </section>
  
</main>
<footer>RedPost</footer>
</body>
</html>