<?php
function promedio($arreglo) {
    $res = 0;
    foreach ($arreglo as $llave => $valor) {
        $res += $valor;
    }
    
    return $res / count($arreglo);
}

$arr = array(
    'Jonathan' => 25,
    'Javier' => 15,
    'Leonardo' => 33,
    'Juan' => 13,
    'Sergio' => 55
);

echo promedio($arr);

$arr2 = array(
    'Luis' => 22,
    'Angel' => 15,
    'Roberto' => 22
);

$arr3 = array(
    'Estudiantes' => $arr,
    'Profesores' => $arr2
);

foreach ($arr as $edad) {
    echo "$edad <br>";
}

foreach ($arr as $nombre => $edad) {
    echo "$nombre tine $edad años<br>";
}

echo '<br>';


$arr3['Administrativos'] = array(
    'Karla' => 32,
    'Monse' => 14,
    'Ana' => 19
);

$arr3[] = array(
    'Sonia' => 23,
    56,
    'Gerardo' => 56
);

foreach ($arr3 as $llave => $valor) {
    echo $llave . " Datos<br>";
    echo '<table>';
    foreach ($valor as $nombre => $edad) {
        echo "$nombre tine $edad años<br>";
    }
    echo '</table>';
}

$a = count($arr);

echo $a;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejemplo arreglos</title>
    </head>
    <body>
        <?php
        foreach ($arr3 as $llave => $valor) {
        ?>
            <h1>
                Datos de <?php echo $llave;?>
            </h1>
            
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Edad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($valor as $nombre => $edad) {
                        ?>
                    <tr>
                        <td>
                        <?php
                        echo $nombre;
                        ?>
                        </td>
                        <td>
                        <?php
                        echo $edad;
                        ?>
                        </td>
                    </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
    </body>
</html>
