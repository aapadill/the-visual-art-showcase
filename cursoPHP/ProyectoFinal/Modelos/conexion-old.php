<?php
define('HOSTDB', 'localhost');
define('USERDB', 'root');
define('PASSWORDDB', 'Welcome1');
define('DATA_BASE', 'tienda');
define('PORT', '3306');

/**
 * Abre una conexion a la BD 
 * usando los datos de las constantes declaradas
 * @return La conexion de la Base de datos
 */
function abrirConexion() {
  $conexion = mysqli_connect(HOSTDB, USERDB, PASSWORDDB, DATA_BASE, PORT);
  if (mysqli_connect_errno()) {
      echo "Fallo al conectar a MySQL: " .  mysqli_connect_error();
      exit();
  }
  return $conexion;
}

/***
 * Ejecuta una consulta en la Base de datos
 * al finalizar la consulta cierra la conexion a la BD
 * @return mysqli_result|bool set de la query
 */
function ejecutarQuery(&$conexion, $sql){
  $resultados = mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  return $resultados;
}

/***
 * Limpia un arreglo de cadenas que
 * seran pasados a la consulta para evitar
 * inyecciones SQL
 * 
 * @param $conexion Conexion de la BD
 * @param $array Arreglo de cadenas o Cadena, el arreglo puede ser asociativo
 * @return mix arreglo/cadena con las cadenas limpiadas por la funcion mysqli_real_escape_string
 */
function limpiarDatos($conexion, $value) {
  if (is_string($value)) {
    return mysqli_real_escape_string($conexion, $value);
  } elseif(is_array($value)) {
    $res = [];
    foreach($value as $llave => $valor) {
      $res[$llave] = limpiarDatos($conexion, $valor);
    }
    return $res;
  } else {
    return $value;
  }
}
?>
