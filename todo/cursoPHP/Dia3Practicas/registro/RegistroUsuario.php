<?php
$titulo = 'Registro Perfil';
$accion = $_SERVER['PHP_SELF'];
$token = $_SESSION['token'];

include __DIR__ . '/header.php';

?>
<form action="<?php echo $accion;?>" method="post">
	<input type="hidden" name="token" value="<?php echo $token;?>">
	<label for="nombre">
		Nombre: 
		<input type="text" name="nombre">
	</label>
	<br>
	<label for="nombre">
		Password: 
		<input type="Password" name="password">
	</label>
	<br>
	<label for="ocupacion">
		Ocupación: <br>
		<textarea rows="4" cols="50" name="ocupacion"></textarea>
	</label>
	<br>
	<label for="sexo">
		Sexo: <br>
		<label><input type="radio" name="sexo" value="Femenino"><span>Femenino</span></label><br>
  		<label><input type="radio" name="sexo" value="Masculino"><span>Masculino</span></label><br>
  		<label><input type="radio" name="sexo" value="Otro"><span>Otro</span></label><br>
	</label>
	<br>
	<label for="lenguajes">
		Lenguajes: <br>
		<label><input type="checkbox" name="lenguaje[]" value="PHP"><span>PHP</span></label><br>
  		<label><input type="checkbox" name="lenguaje[]" value="HTML"><span>HTML</span></label><br>
  		<label><input type="checkbox" name="lenguaje[]" value="Java"><span>Java</span></label><br>
  		<label><input type="checkbox" name="lenguaje[]" value="JavaScript"><span>JavaScript</span></label><br>
  		<label><input type="checkbox" name="lenguaje[]" value="Python"><span>Python</span></label><br>
	</label>
	<br>
	
	<label>Perfil: <br>
		<select name="perfil">
			<option value="">Seleccione una opción</option>
			<option value="Administrador">Administrador</option>
			<option value="Comprador">Comprador</option>
			<option value="Vendedor">Vendedor</option>
		</select>
	</label>
	<br>

	<label for="nombre">
		Imagen Perfil: 
		<input type="file" name="img_perfil">
	</label>
	<br>

	<input type="submit" value="Registrar">

</form>

<?php

include __DIR__ . '/footer.html';
?>