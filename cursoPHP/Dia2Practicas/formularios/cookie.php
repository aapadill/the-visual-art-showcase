<?php
setcookie(
    'cookiePrueba',     // Nombre de la cookie 
    'Valor Cookie!',      // Valor de la cookie
    time() + 3600, // Fecha en segundos en la que expira la cookie
);

if (isset($_COOKIE['cookiePrueba'])) {
    echo $_COOKIE['cookiePrueba'];
} else {
    echo 'Cookie Expiro';
}


