<?php
// Comentario de una linea

/**
 * Comentario de multiples lineas
 */

$variable = 'Hola Mundo!!';
echo $variable;

echo '<br>'; 

//Ejemplo referencias
$b = 'variable';
echo $b;

echo '<br>';

echo $$b;

echo '<br>';

/**
 * Tipos de datos
 * Cuatro tipos escalares:
 *  Booleanos
 *  Enteros
 *  Números de Punto Flotante
 *  Cadenas
 * Dos tipos compuestos:
 *  Arreglos
 *  Objetos
 * Y finalmente dos tipos especiales:
 *  Recursos
 *  Nulo
 */

//NULO
echo null;
echo '<br>';

// BOOLEANOS
$verdadero = true;
$falso = false;

// ENTEROS
echo 1234; //número decimal
echo '<br>';
echo -123; //un número negativo
echo '<br>';
echo 0123; //número octal (83 decimal)
echo '<br>';
echo 0x12; //número hexadecimal (18 decimal) 
echo '<br>';

//FLOTANTES
echo 1.234;
echo '<br>';
echo 1.2e-3; //Notación científica
echo '<br>';

//CADENAS
echo 'Cadena entre comillas simples';
echo '<br>';
echo "Cadena entre comillas dobles interpretan variables $b";
echo '<br>';
$test = <<<EOT
Esto es una cadena muy larga
Puede tener muchos espacios y tambien interpreta las
$variable 
<br>
EOT;
echo $test;

//ARREGLOS
$arregloVacio = array();

$arreglo = [1,2,3,'Cosas', true];

//CONSTANTES
define('MI_CONSTANTE', 'mi constante');
echo MI_CONSTANTE;
echo '<br>';



?>





