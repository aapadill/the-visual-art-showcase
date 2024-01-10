<?php
/*
* Inserta un seguidor en la tabla usuario_seguidor
*
* Utiliza la query 
* INSERT INTO usuario_seguidor(usuario_id, seguidor_id) VALUES
*  (3,1)
* 
* @param true si el registro se actualizo correctamente
*/
function seguir($usuarioId, $seguidorId) {

}


/*
* Borra un seguidor en la tabla usuario_seguidor 
*
* Utiliza la query 
* DELETE FROM usuario_seguidor 
* WHERE 
*      usuario_id = 3 
*      AND seguidor_id = 1
* 
* @param true si el registro se borro correctamente
*/
function dejarSeguir($usuarioId, $seguidorId) {

}
?>