<?php
// Función para comprobar si un número es primo
function esPrimo($numero) {
    if ($numero <= 1) {
        return false; // 0 y 1 no son primos
    }
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            return false; // Es divisible por otro número
        }
    }
    return true; // Es primo
}

// Programa para probar la función esPrimo
$numeroPrueba = 29;
if (esPrimo($numeroPrueba)) {
    echo "$numeroPrueba es un número primo.\n";
} else {
    echo "$numeroPrueba no es un número primo.\n";
}
?>
