<?php

$nomArchivo = "prueba.txt";
// Abrimos el archivo
$archivoE = fopen($nomArchivo, "w");
$texto = "Jonathan Blasio\n";
//var_dump(get_included_files());
fwrite($archivoE, $texto) or die('Archivo Guardado');
echo "Escribiendo $texto en el archivo $nomArchivo";
echo '<br>';
fclose($archivoE);
echo "Archivo $nomArchivo cerrado.";
echo '<br>';

$texto2 = "Hola Mundo!";
$archivoE = fopen($nomArchivo, "a+");
echo "Agregando $texto2 al archivo $nomArchivo";
echo '<br>';
fwrite($archivoE, $texto2);

echo "Archivo $nomArchivo cerrado.";
echo '<br>';
fclose($archivoE);

echo "Contenido del archivo $nomArchivo:";
echo '<br>';
$contenido = file_get_contents($nomArchivo);
echo $contenido;


echo "Abrimos el archivo para leerlo linea por linea";
echo '<br>';
$archivoL = fopen($nomArchivo, "r");
$i = 0;
while (($renglon = fgets($archivoL)) !== false) {
 echo "Renglon $i : $renglon<br>";
 $i++;
}

echo "Cerramos el archivo $nomArchivo";
fclose($archivoL);
