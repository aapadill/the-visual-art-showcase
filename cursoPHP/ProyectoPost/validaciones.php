<?php
/*
* Verifica que el nombre de usuario contenga solo los siguientes 
* caracteres letras minúsculas, numeros y guion bajo
* @param $nombreUsuario Cadena con el nombre de usuario
* @return true si el nombre de usuario contiene solo los caracteres antes mencionados
*/

// var_dump(validarNombreUsuario('prueba_texto1'));
// var_dump(validarPassword('..eTTt1.'));

function validarNombreUsuario($nombreUsuario) {
   $valido = false;
   $pattern = '/^[a-z0-9_]+$/';
   if (preg_match($pattern, $nombreUsuario)){
      $valido = true;
   }
   return $valido;
}

/*
* Verifica que el password contenga 
* al menos 4 caracteres [A-Za-z\d.\-&$%*()]{4,}
* y cumpla con las siguientes condiciones: 
* Una letra minuscula -> (?=.*[a-z])
* Una letra mayuscula -> (?=.*[A-Z])
* Un numero -> (?=.*\d)
* Uno de los siguientes Caracteres especiale .-&$%*() -> (?=.*[.\-&$%*()])
* @param $password Cadena con la contrasenia
* @return true si la contrasenia tiene al menos uno de los caracteres antes mencionados
*/
function validarPassword($password) {
   $valido = false;
   $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.\-&$%*()])[A-Za-z\d.\-&$%*()]{4,}$/';
   if (preg_match($pattern, $password)){
      $valido = true;
   }
   return $valido;
}

/*
* Verifica que el email contenga la siguiente expresion regular 
* ^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$
* @param $email Cadena con el email
* @return true si el email corresponde al patron antes descrito
*/
function validarEmail($email) {
}

/*
* Verifica que el nombre solo contenga letras y espacios en blanco
* @param $password Cadena con la contrasenia
* @return true si el nombre corresponde al patron antes descrito
*/
function validarNombre($nombre) {

}

/*
* Verifica que el nombre de la imagen sea png/jpg
* @param $imagen Cadena con el nombre del archivo cargado
* @return true si el tipo de archivo es el correcto
*/
function validarImagen($imagen) {

}

/*
* Guarda la imagen cargada por el ususario
* en la ruta img/usuarios con el nombre 
* nombreUsuario.(extension)
* @return nombre del archivo cargado si se realizo correctamente la carga
*/
function cargarImagen($imagen, $nombreUsuario) {
  $archivoCargado = false;

  if (is_uploaded_file($imagen['tmp_name'])) {
     move_uploaded_file($imagen['tmp_name'],        
        "img/usuario/" . $imagen['name']);
     $archivoCargado = "img/usuario/" . $imagen['name'];
  }
  return $archivoCargado;
}
?>