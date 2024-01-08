<?php
$x = 3;
// Comillas simples no se interpretan las variables
echo 'ejemplo $x <br/>';
// Comillas Dobles si se interpretan las variables
echo "ejemplo $x <br/>";

$uno = 1;
$dos = 2;
$tres = 3;
$cuatro = 4;
$arr = array(5,6);

/* Las comillas dobles hacen mas legibles las concatenaciones */
$tesComillasDobles = " $uno $dos $tres $cuatro {$arr[0]} {$arr[1]} <br/>";
echo $testDoble;

// Juszgalo tu mismo con las comillas simples
$testComillasSimples = ' ' . $uno . ' ' . $dos . ' ' . $tres . ' ' . $cuatro . ' ' . $arr[0] . ' ' . $arr[1] . ' <br/>';
?>
