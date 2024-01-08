<?php
/*
* Inserta un usuario en la tabla usuario
* Utiliza la query 
* INSERT INTO usuarios (nombre_usuario, password, email, nombre, img_usuario) VALUES
*  ('leon', 'Hola1234', 'test@test.com', 'Leon', 'img/usuarios/user.png')
*
* 
* @param array con los datos de usuario
*/
function insertarUsuario($datos) {

}

/*
* Verifica que el usuairo y Contrasenia correspondan a un usuario
* y regresa los dato del usuario
* Utiliza la query 
* SELECT  usuario_id, nombre_usuario, email, nombre, img_usuario
* FROM usuarios
* WHERE
*     nombre_usuario = 'leon'
*     AND password = 'Hola1234'
* @param array con los dato sde usuario
*/
function verificarLogin($usuario, $password) {

}
?>