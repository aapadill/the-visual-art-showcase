<?php
function suma ($a, $b) {
    echo "$a + $b = " . ($a + $b);
}

function resta ($a, $b) {
    echo "$a - $b = " . ($a - $b);
}

function multiplicacion ($a, $b) {
    echo "$a * $b = " . ($a * $b);
}

suma(2, 5);
echo '<br>';
resta (10, 6);
echo '<br>';
multiplicacion(5, 5);