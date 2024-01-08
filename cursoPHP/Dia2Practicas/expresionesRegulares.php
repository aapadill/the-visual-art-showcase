<?php
// Expresiones Regulares

/**
 * Nuevos caracteres especiales
 * Carácter especial  Valor
 * \w Cualquier carácter palabra.
 * \s Cualquier espacio.
 * \d Cualquier digito decimal.
 * \v Cualquier espacio en blanco vertical.
 * \h Cualquier espacio en blanco horizontal.
 * Escape en mayúsculas Los caracteres que no están en la clase definida. *alfa
*/
// Espacios en blanco
$patron = "/\s/";
$cadena = "Hola\n\r\tMundo";
echo "preg_match($patron, $cadena) = ";
echo preg_match($patron, $cadena);
echo '<br>';

$patron = "/\D/"; //*alfa, lo que no este definido en cadena, en este caso numeros
$cadena = "1234567890";  
echo "preg_match($patron, $cadena) = ";
echo preg_match($patron, $cadena);
echo '<br>';

$cadena = "abcdefg";
echo "preg_match($patron, $cadena) = ";
echo preg_match($patron, $cadena);
echo '<br>';

/**
 * Operadores
 * ^       Busca al inicio de la cadena.
 * $       Busca al final de la cadena.
 * .       Cualquier carácter excepto una nueva línea.
   *       Busca el patrón cero o mas veces.
 * +       Busca el patrón una o mas veces.
 * ?       Busca el patrón una o cero veces.
 * {n}     Busca el patrón exactamente n veces.
 * {n,}    Busca el patrón al menos n veces.
 * () o [] Se usan para agrupar patrones.
 * |       Operador OR.
*/
$patron = "/^[ab]{5}$/"; //empiece con a o b, y 5 veces de cualquiera
$cadena = "abbaa";
echo "preg_match($patron, $cadena) = "; 
echo preg_match($patron, $cadena);
echo '<br>';

$patron = "/^(ab){5}$/";
$cadena = "abbaa";
echo "preg_match($patron, $cadena) = ";
echo preg_match($patron, $cadena);
echo '<br>';

$cadena = "ababababab";
echo "preg_match($patron, $cadena) = ";
echo preg_match($patron, $cadena);
echo '<br>';

/**
 * i La búsqueda es insensible a minúsculas y mayúsculas.
 * m Busca en cada nueva linea de la cadena al inicio o al final si usamos ^ $.
 * A Busca solo al inicio de la cadena no en cada nueva linea si usamos ^. (default) 
 * D Busca solo al final de la cadena no en cada nueva linea si usamos $. (default)
 * s Hace que el  . conincida con el salto de linea \n.  
 * x Se ignoran los caracteres con espacios en blanco dentro del patron.
 */
$patron = "/^hola$/i"; 
$cadena = "HolA";
echo "preg_match($patron, $cadena) = ";
echo preg_match($patron, $cadena);
echo '<br>';

 $patron = "/^mundo/m";
$cadena = "Hola 
mundo";
echo "preg_match($patron, $cadena) = ";
echo preg_match($patron, $cadena);
echo '<br>';

$patron = "/^Hola.mundo/s";
$cadena = "Hola\nmundo!";
echo "preg_match($patron, $cadena) = ";
echo preg_match($patron, $cadena);
echo '<br>';

$patron = "/h o l a/ix";
$cadena = "HolA";
echo "preg_match($patron, $cadena) = ";
echo preg_match($patron, $cadena);
echo '<br>';

//PREG_MATCH_ALL
$patron = "/ab/";
$cadena = "ababababab";
echo "preg_match_all($patron, $cadena) = ";
echo preg_match_all($patron, $cadena);
echo '<br>';

//PREG_REPLACE
$patron = "/ab/";
$cadena = "ababababab";
$remplazo = "zx";
echo "preg_replace($patron, $remplazo, $cadena) = ";
echo preg_replace($patron, $remplazo, $cadena);
echo '<br>';

?>