<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', null);
define('DATA_BASE', 'social');

$conexion = abrirConexion();
$sql = $resultados = "SELECT * FROM usuarios;";
$resultado  = ejecutarQuery($conexion, $sql);

// foreach($resultado as $renglones){
//     var_dump($renglones);
//     echo '<br>';
// }

/*
* Abre una conexion a la BD 
* usando los datos de las constantes declaradas
* @return La conexion de la Base de datos
*/
function abrirConexion() {
    $conexion = mysqli_connect(HOST, USER, PASSWORD, DATA_BASE);
    return $conexion;
}

/*
* Ejecuta una consulta en la Base de datos
* al finalizar la consulta cierra la conexion a la BD
* @return result set de la query
*/
function ejecutarQuery($conexion, $sql){
    $resultados = mysqli_query($conexion, $sql);
    mysqli_close($conexion);
    return $resultados;
}

/*
* Limpia un arreglo de cadenas que
* seran pasados a la consulta para evitar
* inyecciones SQL
* @param $conexion Conexion de la BD
* @param $array Arreglo de cadenas, el arreglo puede ser asociativo
* @resturn un arreglo con las cadenas limpiadas por la funcion mysqli_real_escape_string
*/
function limpiarDatos($conexion, $array) {

}
