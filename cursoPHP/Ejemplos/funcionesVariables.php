<?php
$nullVar = null;
$cero = 0;
$cadenaVacia = "";
$arregloVacio = [];
$verdadero = true;
$falso = false;
?>

<table border="1">
  <tr>
    <th>Valores</th>
    <th colspan="8">Funciones</th>
  </tr>
  <tr>
    <th></th>
    <th>isset()</th>
    <th>empty()</th>
    <th>print_r()</th>
    <th>var_dump()</th>
    <th>is_numeric()</th>
    <th>is_bool()</th>
    <th>is_null()</th>
    <th>is_string()</th>
  </tr>
  <tr>
    <th>Variable no Declarada</th>
    <td><?php echo isset($variableNoDeclarada); ?></td>
    <td><?php echo empty($variableNoDeclarada); ?></td>
    <td><?php echo print_r($variableNoDeclarada); ?></td>
    <td><?php var_dump($variableNoDeclarada); ?></td>
    <td><?php echo is_numeric($variableNoDeclarada); ?></td>
    <td><?php echo is_bool($variableNoDeclarada); ?></td>
    <td><?php echo is_null($variableNoDeclarada); ?></td>
    <td><?php echo is_string($variableNoDeclarada); ?></td>
  </tr>
  <tr>
    <th>Cero 0</th>
    <td><?php echo isset($cero); ?></td>
    <td><?php echo empty($cero); ?></td>
    <td><?php print_r($cero); ?></td>
    <td><?php var_dump($cero); ?></td>
    <td><?php echo is_numeric($cero); ?></td>
    <td><?php echo is_bool($cero); ?></td>
    <td><?php echo is_null($cero); ?></td>
    <td><?php echo is_string($cero); ?></td>
  </tr>
  <tr>
    <th>Verdadero true</th>
    <td><?php echo isset($verdadero); ?></td>
    <td><?php echo empty($verdadero); ?></td>
    <td><?php print_r($verdadero); ?></td>
    <td><?php var_dump($verdadero); ?></td>
    <td><?php echo is_numeric($verdadero); ?></td>
    <td><?php echo is_bool($verdadero); ?></td>
    <td><?php echo is_null($verdadero); ?></td>
    <td><?php echo is_string($verdadero); ?></td>
  </tr>
  <tr>
    <th>Falso false</th>
    <td><?php echo isset($falso); ?></td>
    <td><?php echo empty($falso); ?></td>
    <td><?php print_r($falso); ?></td>
    <td><?php var_dump($falso); ?></td>
    <td><?php echo is_numeric($falso); ?></td>
    <td><?php echo is_bool($falso); ?></td>
    <td><?php echo is_null($falso); ?></td>
    <td><?php echo is_string($falso); ?></td>
  </tr>
  <tr>
    <th>null</th>    
    <td><?php echo isset($nullVar); ?></td>
    <td><?php echo empty($nullVar); ?></td>
    <td><?php print_r($nullVar); ?></td>
    <td><?php var_dump($nullVar); ?></td>
    <td><?php echo is_numeric($nullVar); ?></td>
    <td><?php echo is_bool($nullVar); ?></td>
    <td><?php echo is_null($nullVar); ?></td>
    <td><?php echo is_string($nullVar); ?></td>
  </tr>
  <tr>
    <th>Cadena Vacia ''</th>
    <td><?php echo isset($cadenaVacia); ?></td>
    <td><?php echo empty($cadenaVacia); ?></td>
    <td><?php print_r($cadenaVacia); ?></td>
    <td><?php var_dump($cadenaVacia); ?></td>
    <td><?php echo is_numeric($cadenaVacia); ?></td>
    <td><?php echo is_bool($cadenaVacia); ?></td>
    <td><?php echo is_null($cadenaVacia); ?></td>
    <td><?php echo is_string($cadenaVacia); ?></td>
  </tr>
  <tr>
    <th>Arreglo Vacio []</th>
    <td><?php echo isset($arregloVacio); ?></td>
    <td><?php echo empty($arregloVacio); ?></td>
    <td><?php print_r($arregloVacio); ?></td>
    <td><?php var_dump($arregloVacio); ?></td>
    <td><?php echo is_numeric($arregloVacio); ?></td>
    <td><?php echo is_bool($arregloVacio); ?></td>
    <td><?php echo is_null($arregloVacio); ?></td>
    <td><?php echo is_string($arregloVacio); ?></td>
  </tr>

</table>