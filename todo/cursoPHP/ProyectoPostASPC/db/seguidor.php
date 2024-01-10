<?php
/**
* Consulta los usuarios 
* seguidos por el $usuarioId
* 
* Utilizando la siguiente query
*
* 
SELECT  U.nombre_usuario, U.usuario_id, U.img_usuario,
   (SELECT count(1) 
    FROM usuario_seguidor US 
    WHERE 
     US.usuario_id = U.usuario_id 
     AND US.seguidor_id = $usuarioId
   ) seguido
FROM 
   usuarios U
WHERE
   usuario_id <> $usuarioId
*/
function listarSeguidores($usuarioId) {
    $conexion = abrirConexion();
    $usuarioIdLipio = limpiarDatos($conexion, $usuarioId);
    $sql = "
    SELECT  U.nombre_usuario, U.usuario_id, U.img_usuario,
    (SELECT count(1) 
     FROM usuario_seguidor US 
       WHERE 
          US.usuario_id = U.usuario_id 
          AND US.seguidor_id = $usuarioIdLipio
       ) seguido
    FROM 
       usuarios U
    WHERE
       usuario_id <> $usuarioIdLipio
    ";
 
    $resulatdos = ejecutarQuery($conexion, $sql);
    return $resulatdos;
 }

/**
* Inserta un seguidor en la tabla usuario_seguidor
*
* Utiliza la query 
INSERT INTO usuario_seguidor(usuario_id, seguidor_id) VALUES
 (3,1)
* 
* @param true si el registro se actualizo correctamente
*/
function seguir($usuarioId, $seguidorId) {
    $conexion = abrirConexion();
    $usuarioId = limpiarDatos($conexion, $usuarioId);
    $seguidorId = limpiarDatos($conexion, $seguidorId);
    $sql = "INSERT INTO usuario_seguidor(usuario_id, seguidor_id) VALUES
    ($usuarioId,$seguidorId)";
    $res = ejecutarQuery($conexion, $sql);
    return $res;
}

/**
* Borra un seguidor en la tabla usuario_seguidor 
*
* Utiliza la query 
DELETE FROM usuario_seguidor 
WHERE 
    usuario_id = 3 
    AND seguidor_id = 1
* 
* @param true si el registro se borro correctamente
*/
function dejarSeguir($usuarioId, $seguidorId) {
    $conexion = abrirConexion();
    $usuarioId = limpiarDatos($conexion, $usuarioId);
    $seguidorId = limpiarDatos($conexion, $seguidorId);
    $sql = "DELETE FROM usuario_seguidor 
    WHERE 
        usuario_id = $usuarioId 
        AND seguidor_id = $seguidorId";
    $res = ejecutarQuery($conexion, $sql);
    return $res;
}
?>