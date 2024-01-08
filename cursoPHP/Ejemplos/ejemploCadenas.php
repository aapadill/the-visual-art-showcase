<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mi primera Pagina en Php</title>
    </head>
    <body>
        <?php
        $x = 10;
        $y = 20;
        
        $comillasSimples = 'x + y = $x + $y';
        $comillasDobles = "x + y = $x + $y";
        $resultado = "x + y = " . ($x + $y); 
        echo $comillasSimples;
        echo '<br />';
        echo $comillasDobles;
        ?>
        <br />
        
        <?php
        echo $resultado;
        ?>
    </body>
</html>

