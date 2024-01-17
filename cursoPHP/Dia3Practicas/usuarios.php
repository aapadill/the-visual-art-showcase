
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
  <style>
  table {
    margin-left: auto; 
    margin-right: auto;
  }
  </style>
</head>
<body>
	<header><h1>Usuarios</h1></header>
	<main>
    <p><a href="registro.php">Registrar Usuario</a></p>
    <table>
      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th>Nombre de Usuario</th>
          <th>Email</th>
          <th>Password</th>
          <th>Nombre</th>
          <th>Imagen</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <form action="eliminar.php">
              <input type="submit" value="✖">
            </form>
            <a href="registro.php"><input type="button" value="✐"></a>  
          </td>
          <td>ID</td>
          <td>Nombre de Usuario</td>
          <td>Email</td>
          <td>
            <details>
              <summary>Password</summary>
              <b>Password</b>
            </details>
          </td>
          <td>Nombre</td>
          <td>
            <details>
              <summary>Imagen</summary>
                <figure>
                  <img alt="Usuario" src="img/usuarios/user.png" />
                  <figcaption>Nombre</figcaption>
                </figure>
            </details>  
          
        
          </td>
        </tr>
      </tbody>
    </table>
  </main>
<footer>Mi Curso PHP</footer>
</body>
</html>