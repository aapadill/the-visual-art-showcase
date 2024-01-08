<?php
// Operadores Aritmeticos
$x = 10;
$y = 7;
echo "$x + $y = " . ($x + $y);
echo '<br>';
echo "$x - $y = " . ($x - $y);
echo '<br>';
echo "$x / $y = " . ($x / $y);
echo '<br>';
echo "$x % $y = " . ($x % $y);
echo '<br>';

// Incremento / Decremento
echo "Postincremento $x++ = " . ($x++);
echo '<br>';
echo "Preincremento ++$x = " . (++$x);
echo '<br>';
echo "PostDecremento $x-- = " . ($x--);
echo '<br>';
echo "Predecremento --$x = " . (--$x);
echo '<br>';

// Operadores De asignacion
$a = 8;
echo "Valor a: $a <br>";
$a += 2;
echo "Suma 2 : $a <br>";
$a -= 4;
echo "Resta 4: $a <br>";
$a *= 5;
echo "Multiplica 5 : $a <br>";
$a /= 3;
echo "Divide 3: $a <br>";
++$a;
echo "Incrementa 1: $a <br>";
--$a;
echo "Decrementa 1 : $a <br>";

// UNSET 
$a = 1;
$b = $a;
unset ($a); // Pero $b sigue valiendo 1
echo '<br>';

function funcion(&$var) {
    $var++;
}
$varReferencia = 5;
funcion($varReferencia);
// $a es 6
echo $varReferencia; 
echo '<br>';

// RECORRER CADENA
$cadena = "Hola" . " mundo!";
for ($i = 0; $i < strlen($cadena); $i++) {
  echo $cadena[$i] . "<br>";
}

//ARREGLOS

//Declaración agregando datos sin llave
$arregloViejo = array('Jonathan' , 'Blasio');
$arregloSimple = ['Hola' , 'Mundo!', 4];

//Declaración agregando datos con llave    
$arreglo = [
    'nombre' => 'Jonathan',
    'apellido' => 'Blasio',
    'edad' => 27
];
//Agregar dato sin llave    
$arreglo[] = 'Jonathan';
//Agregar dato sin llave al final
array_push($arreglo, 'Blasio');
//Agregar dato con llave
$arreglo['pasatimepo'] = 'Leer';

for ($i = 0; $i < count($arregloSimple); $i++) {
	echo "{$arregloSimple[$i]} <br>";
} 

?>
