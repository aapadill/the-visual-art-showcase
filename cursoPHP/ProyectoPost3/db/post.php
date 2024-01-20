<?php

/**
* Consulta los posts creador por los usuarios
* seguidos por el $usuarioId
* Utilizando la siguiente query
*
SELECT P.texto, P.img_post, U.nombre_usuario, U.img_usuario
FROM
    usuarios U,
    usuario_seguidor US,
    posts P
WHERE
    P.usuario_id = US.usuario_id
    AND U.usuario_id = US.usuario_id
    AND US.seguidor_id = $usuarioId
*
* @return ResultSet con los datos de la query
*/

function queryPost($usuarioId){
    $conexion = abrirConexion();
    $usuarioId = limpiarDatos($conexion, $usuarioId);
    $sql = "
    SELECT P.texto, P.img_post, U.nombre_usuario, U.img_usuario
    FROM
        usuarios U,
        usuario_seguidor US,
        posts P
    WHERE
        P.usuario_id = US.usuario_id
        AND U.usuario_id = US.usuario_id
        AND US.seguidor_id = $usuarioId
    ORDER BY
        P.fecha_creacion DESC
    ;";
    $resultado = ejecutarQuery($conexion, $sql);
    return $resultado;
}

/**
* Inserta un registro en la tabla posts
* Utilizando la siguiente query
*
 INSERT INTO posts(usuario_id, texto, img_post) VALUES
        ($usuarioId, '$texto', '$imagen')
*
* @return true si el post se registro correctamente
*/

function crearPost($usuarioId, $texto, $imagen){
    //Conectarse
    $conexion = abrirConexion();
    //Limpiar Datos
    $usuarioId = limpiarDatos($conexion, $usuarioId);
    $texto = limpiarDatos($conexion, $texto);
    $imagen = limpiarDatos($conexion, $imagen);
    $sql = "
    INSERT INTO posts(usuario_id, texto, img_post) VALUES
        ($usuarioId, '$texto', '$imagen')
    ;";
    //Ejecutar Query
    $resultado = ejecutarQuery($conexion, $sql);
    return $resultado;
}
?>