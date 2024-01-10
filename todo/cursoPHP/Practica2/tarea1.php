<?php
/**
 * Función que calucula el promedio de dos números
 */
function promedio($a, $b) {
    return ($a+$b)/2;
}
$x = 4;
$y = 6;
echo "el promedio de $x y $y es: " . promedio($x, $y);

/**
 * Función que divide dos números
 */
function divide($a, $b) {
    return ($a/$b);
}
echo "<br> $x/$y es: " . divide($x, $y);

/**
 * Función para calcular el porcentaje 
 * de un número
 *
 * @param $a Valor al que se le calculará el porcentaje
 * @param $porcentaje Procentaje que se quiere ser obtenido
 * este no puede ser menor a 0 ni mayor a 100
 */
function porcentaje($a, $porcentaje) {
    if ($porcentaje >= 0 && $porcentaje <= 100){
        return ($a*$porcentaje/100);
    }
    else{
        return "error, porcentaje fuera de rango";
    }
}
echo "<br> el $y% de $x es: " . porcentaje($x, $y);

/**
 * Función para calcular el minimo de dos numeros 
 */
function minimo($a, $b) {
    if ($a > $b){
        return $b;
    }elseif ($a < $b){
        return $a;
    }else{
        return "los numeros son iguales";
    }
}
echo "<br> el numero mayor de $x y $y es: " . minimo($x, $y);

/**
 * Función para calucular el mmaximo de dos numeros 
 */
function maximo($a, $b) {
    if ($a < $b){
        return $b;
    }elseif ($a > $b){
        return $a;
    }else{
        return "los numeros son iguales";
    }
}
echo "<br> el numero mayor de $x y $y es: " . maximo($x, $y);

/**
 * Función para calucular el minimo de un arreglo 
 */
function minArreglo($arreglo) { //validar tamaño del arreglo > 0
    $len = count($arreglo);
    if ($len === 0) {
        return "arreglo vacio"; //arreglo vacio
    }
    $menor = $arreglo[0];
    foreach($arreglo as $actual){
        if ($menor > $actual){
            $menor = $actual;
        }
    }
    return $menor;
}
$test = array(1, 5, 2, 45, 8, 4, -11);
echo "<br> el numero menor del arreglo es: " . minArreglo($test);

/**
 * Función que calucula el factorial de un número
 */
function factorial($n) {
    if ($n <= 1){
        return 1;
    }else{
        return $n * factorial($n - 1);
    }
}
$num = 4;
echo "<br> Factorial de $num es: " . factorial($num);

/**
 * Función que regresa el promedio
 * de un arreglo de numeros
 */
function promedioArreglo($arreglo) {
    $len = count($arreglo);
    if ($len === 0){
        return 0; //el arreglo tamano 0 puede provocar division entre 0, lo consideramos
    }
    $sum = 0;
    foreach ($arreglo as $n){
        $sum += $n;
    }
    return $sum/$len;
}
echo "<br> promedioArreglo de array es: " . promedioArreglo($test);

/**
 * Función para elevar a la potencia
 * deseada un numero
 * La potencia debe de ser un entero positivo
 */
function exponente($x, $n) {
    if ($n < 0) {
        return "potencia debe ser entero positivo";
    }
    $res = 1;
    for ($i = 0; $i < $n; $i++){
        $res *= $x;
    }
    return $res;
}
$n = 4;
echo "<br> $x a la $n es: " . exponente($x, $n);

/**
 * Función para presentar la bebida de un pedido
 * Las únicas bebidas disponibles son : Café, Té y Jugo
 * En caso que la bebida sea diferente regresara el mensaje
 * "No contamos con la bebida que ha elegido"
 * En el caso que sea café regresara el mensaje
 * "Disfrute nuestro delicioso Café caliente"
 * En caso que sea Té
 * "Disfrute nuestro sano Té caliente"
 * En caso que sea Jugo
 * "Disfrute nuestro natural Jugo del día" 
 */
function ordenarBebida($bebida) {
    switch ($bebida){
        case 'Café':
        case 'Cafe':
        case 'cafe':
            return "Disfrute nuestro delicioso Café caliente";
        case 'Té':
        case 'Te':
        case 'te':
            return "Disfrute nuestro sano Té caliente";
        case 'Jugo':
            return "Disfrute nuestro natural Jugo del día";
        default:
            return "No contamos con la bebida que ha elegido";
    }
}
echo "<br> " . ordenarBebida("te");

/**
 * Realiza un función que invierta los caracteres de una cadena
 * Ejemplo invertir("Jonathan") = "nahtanoJ"
*/
function invertir($cadena) {
    $len = strlen($cadena);
    $cadenaInv = '';
    for ($i = $len-1; $i >= 0; $i--){
        $cadenaInv .= $cadena[$i];
    }
    return $cadenaInv;
}
$cadena = "Jonathan desayuna unos chilaquiles verdes";
echo "<br> " . invertir($cadena);

/**
 * Implemenata la funcion palindromo
 * La cual evalua si una cadena es un
 * palindromo.
 * Esto quiere decir que se lee de la misma manera
 * de atras hacia adelante y de adelante hacia atras.
 * Ejemplo:
 * palindromo("Hola") = false
 * palindromo("JonathanahtanoJ") = true
*/
function palindromo($cadena){
    $cadena = strtolower(str_replace(' ', '', $cadena)); //normalizacion espacios y mayusculas
    $cadenaInv = invertir($cadena);
    return $cadena === $cadenaInv;
}
$ejemplo = "Anita lava la tina";
echo "<br>la frase -$ejemplo- es un palindromo?: " . (palindromo($ejemplo) ? 'si' : 'no');

/**
 * Implementa la función Fibbonacci 
 * La función fibonacci se define
 * fibonacci(0) = 0
 * fibonacci(1) = 1
 * fibonacci(n) = fibonacci(n - 1) + fibonacci(n -2)
 * letra dada en el segundo parametro
 * Ejemplo fibonacci(6) = 8
 *
*/
function fibonacci($n) {
    if ($n <= 0){
        return 0;
    }elseif ($n == 1){
        return 1;
    }else{
        return fibonacci($n - 1) + fibonacci($n - 2);
    }
}
$o = 8;
echo "<br> fibo en pos $o es " . fibonacci($o);

/**
 * Realizar una función que reciba una cadena  de texto.
 * Debe devolver un array que indique:
 * a) La cantidad de letras vocales por cada vocal
 * (cantidad de “a”, de “e”, de “i”, de “o” y de “u”)
 * Ejemplo conteoVocales(Jonathan) = ['a' => 2, 'e' => 0, 'i' => 0, 'o' => 1, 'u' => 0] 
*/
function conteoVocales($cadena) {
    //comodin jejej
}

/**
 * Implementa la función que convierta un
 * número decimal a una base dada
 * La base solo puede ser un numero entero positivo menor a 10
 * a la base deseada
 * Ejemplo: cambioBase(10, 2) = 1010 
 *
 */
function cambioBase($n, $base) {
    if ($base < 2 || $base > 9){
        return "escribe alguna base entre 2 y 9";
    }

    $resultado = '';
    while ($n > 0){
        $residuo = $n % $base;
        $resultado = $residuo . $resultado; //al pasar de base 10 a base menor, el numero se construye con los residuos que van apareciendo de derecha (residuo[len-1]) a izquierda (residuo[0])
        $n = (int)($n / $base);
    }
    return $resultado;
}
$numer = 100;
$base = 2;
echo "<br> $numer en base $base es: " . cambioBase($numer, $base);