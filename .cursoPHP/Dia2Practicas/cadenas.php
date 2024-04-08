<?php
// Cadenas comillas simples
echo 'Cadena entre comillas simples';
echo '<br>';

// Cadenas comillas dobles
$variable = "Valor Mi Variable";
echo "Cadena entre comillas dobles interpretan variables $variable";
echo '<br>';

// Cadenas Largas
$test = <<<EOT
<div style="background: #000; color:white;" class='test'>
Esto es una cadena muy larga
Puede tener muchos espacios y tambien interpreta las
$variable
</div>
EOT;

echo $test;

//Escape de caracters comillas simples
$comillasSimples = '
Comillas Simples
Escape de: \'<br>
Escape de: \\<br>
Caracteres que no se son validos \n\t
';
echo $comillasSimples;
echo '<br>';
//Escape de caracters comillas dobles
$comillasDobles = "
Escape de: \"<br>
Caracteres Adicionales \\n \n
\\t \t \\r \r
";
echo $comillasDobles;
echo '<br>';

$uno = 1;
$dos = 2;
$tres = 3;
$cuatro = 4;
$arr = [5,6];

// Concatnacion
$testComillasSimples = ' ' . $uno . ' ' . $dos . ' ' . $tres . ' ' . $cuatro . ' ' . $arr[0] . ' ' . $arr[1] . ' <br/>';
echo $testComillasSimples;

// Las comillas dobles hacen mas legibles las concatenaciones
$testComillasDobles = " $uno $dos $tres $cuatro {$arr[0]} {$arr[1]} <br/>";
echo $testComillasDobles;
echo '<br>';

// Recorrer Cadenas
$cadena = "Hola\t mundo!\n";
for ($i = 0; $i < strlen($cadena); $i++) {
    echo $cadena[$i] . "<br>";
}

//TRIM
$rtrim = "Cadena con espacios a la derechaZZZZZZZZ";
$ltrim = "ZZZZZZCadena con espacios a la izquierda";

//Cadenas con espacios
echo $ltrim . $rtrim;
echo '<br>';

//Cadena con TRIM quita estacios a la derecha
echo trim($ltrim . 'ZZZZZZ' . $rtrim, 'Z');
echo '<br>';

//LTRIM y RTRIM
echo rtrim($rtrim, 'Z');
echo ltrim($ltrim, 'Z');
echo '<br>';

//Aplicao LTRIM en caracter con espacios a la derecha
echo ltrim($rtrim, 'Z');
//Aplicao RTRIM en caracter con espacios a la izquierda
echo rtrim($ltrim, 'Z');
echo '<br>';

//HTML ENTITIES
$script = "<script>alert('Entrada Maliciosa')</script>";
echo htmlentities($script); //wtffff el servidor escapa todas las etiquetas script
echo '<br>';

//SUBSTRING
$cadena = "Hola Mundo!";
echo "substr($cadena, 0, ". strlen($cadena) . ") =";
echo substr($cadena, 0, strlen($cadena));
echo '<br>';

echo "substr($cadena, 1, 5) =";
echo substr($cadena, 1, 5);
echo '<br>';

//REMPLAZO
$cadena = "Hola Mundo!";
$busqueda = "Mundo";
$remplazo = "a Todos";
echo "str_replace($busqueda, $remplazo, $cadena) =";
echo str_replace($busqueda, $remplazo, $cadena);
echo '<br>';



