<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mi primera Pagina en Php</title>
    </head>
    <body>
        <?php
        $aregloProductos = array(
            'Libros',
            'Lapices',
            'Cuadernos',
            'Gises'
            
        );
        ?>
        <h2>Lista Productos</h2>
        <ol>
            <?php
            foreach ($aregloProductos as $valor) {
                echo '<li>';
                echo $valor;
                echo '</li>';
            }
            ?>
        </ol>
        
        <?php
        $productosPrecio = array(
            'Libros' => 23.5,
            'Lapices' => 12.3,
            'Cuadernos' => 16.3,
            'Gises' => 15.4
        );
        ?>
        <h2>Table de Productos con precio</h2>
        <table>
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach ($productosPrecio as $llave => $valor) {
                    echo '<tr>';
                        echo '<td>';
                        echo $llave;
                        echo '</td>';
                        echo '<td>';
                        echo $valor;
                        echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <?php
        function minimo ($arreglo) {
            $min = $arreglo[0];
            foreach ($arreglo as $valor) {
                if ($valor < $min) {
                    $min = $valor;
                }
            }
            
            return $min;
        }
        
        function maximo ($arreglo) {
            $max = $arreglo[0];
            foreach ($arreglo as $valor) {
                if ($valor > $max) {
                    $max = $valor;
                }
            }
            
            return $max;
        }
        
        $aregloValores = array(
            20,
            5,
            6,
            7,
            10,
            5,
            40,
        );
        
        echo '<br>';
        echo minimo($aregloValores);
        echo '<br>';
        echo maximo($aregloValores);
        ?>
    </body>
</html>


