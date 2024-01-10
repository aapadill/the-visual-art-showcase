<?php
// Arreglo vacio
$arregloViejo = array();
$arreglo = [];

// Declaración agregando datos sin llave
$arregloViejo = array('Jonathan' , 'Blasio');
$arregloSimple = ['Hola' , 'Mundo!', 4];

var_dump($arregloViejo);
echo "<br>";
var_dump($arregloSimple);
echo "<br>";

// Declaración agregando datos con llave    
$arreglo = [
    'nombre' => 'Jonathan',
    'apellido' => 'Blasio',
    'edad' => 27
];
var_dump($arreglo);
echo "<br>";

// Agregar dato sin llave    
$arreglo[] = 'Jonathan';
// Agregar dato sin llave al final
array_push($arreglo, 'Blasio');
// Agregar dato con llave
$arreglo['pasatimepo'] = 'Leer';
var_dump($arreglo);

echo "<br>";
echo "<br>";

// Recorrer arreglo FOR
echo "Arreglo Simple:<br>";
for ($i = 0; $i < count($arregloSimple); $i++) {
    echo '$arregloSimple[' . $i . '] = ';
	echo "{$arregloSimple[$i]} <br>";
} 
echo "<br>";

// Recorrer arreglo FOREACH
echo "Arreglo  Valor:<br>";
foreach ($arreglo as $valor) {
	echo "$valor <br>";
}
echo "<br>";

// Recorrer arreglo llave valor
echo "Arreglo Llave Valor:<br>";
foreach ($arreglo as $llave => $valor) {
    echo '$arregloSimple[' . $llave . '] = ';
	echo "$valor <br>";
}

// Eliminar Valor
echo "<br>unset(0) = ";
unset($arreglo[0]);
var_dump($arreglo);
echo "<br>";

// Busqueda en arreglo
echo "<br>";
echo 'array_search("Jonathan", $arreglo) = ';
echo array_search('Jonathan', $arreglo);
echo "<br>";

// Diferencia de arreglos
echo "<br>";
echo 'array_diff(';
var_dump($arreglo);
echo ', <br>';  
var_dump($arregloViejo);
echo ') = ';
$resultado = array_diff($arreglo, $arregloViejo);
echo "<br>";
var_dump($resultado);
echo "<br>";

// Mezcla de arreglos
echo "<br>";
echo 'array_merge(';
var_dump($arreglo);
echo ', <br>';  
var_dump($arregloViejo);
echo ') = ';
$resultado = array_merge($arreglo, $arregloViejo);
echo "<br>";
var_dump($resultado);
echo "<br>";

// Implode
echo "<br>";
echo 'implode(';
var_dump($arreglo);
echo ') = ';
$resultado = implode(', ', $arreglo);
echo "<br>";
echo $resultado;
echo "<br>";

//Explode
echo "<br>";
echo "explode($resultado)";
$resultado = explode(', ', $resultado);
echo "<br>";
var_dump($resultado);
echo "<br>";
?>