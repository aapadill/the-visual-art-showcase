<?php
include '../../config/cargador.php';
use Controladores\Router;
use Modelos\Direccion;

//echo debug
echo '<pre>';
echo '$_POST: ';
var_dump($_POST);

$direccion = $_POST; //arreglo

$algunCampoVacio = empty($direccion['nombre']) || empty($direccion['calle_numero']) || empty($direccion['cp']) || empty($direccion['colonia']) || empty($direccion['municipio']) || empty($direccion['estado']);

$direccionOBJ = new Direccion($direccion); //objeto
//debug
echo '$direccionOBJ: ';
var_dump($direccionOBJ); //objeto

$existeDireccion = $direccionOBJ->existe($direccion['direccion_id']);
$existeNombreDireccion = $direccionOBJ->existe2($direccion['nombre'], $direccion['usuario_id']);
// $direccionNueva = ($direccion['direccion_id']=="n") ? 1 : 0;

if (Router::esGet() || $algunCampoVacio || !$existeDireccion){ // || $existeNombreDireccion
  echo '$algunCampoVacio: ';
  var_dump($algunCampoVacio);
  echo '$existeDireccion: ';
  var_dump($existeDireccion);
  echo '$existeNombreDireccion: ';
  var_dump($existeNombreDireccion);
  Router::redireccionar('direcciones/index.php');
}

//click en editar
if (!$algunCampoVacio) { 
  //7.b.c) edita o registra direccion
  if (!$existeNombreDireccion){
    $insertado = $direccionOBJ->guardar(); //podrias pasar existeDireccion como param
  }
  if ($existeNombreDireccion){ //o direccion nueva
    // mensaje de sobreescritura
    $insertado = $direccionOBJ->guardar2(); //podrias pasar existeNombreDireccion como param
  }

  //debug
  echo 'insercionSQL: ';
  var_dump($insertado);

  Router::redireccionar('direcciones/index.php');
}