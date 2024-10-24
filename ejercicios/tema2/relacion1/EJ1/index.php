<?php
function factorial($n) {
    // Caso base: el factorial de 0 es 1
    if ($n === 0) {
        return 1;
    }
    // Caso recursivo: n! = n * (n-1)!
    return $n * factorial($n - 1);
}

// Prueba de la función
$numero = 5; // Cambia este valor para probar con otros números
$resultado = factorial($numero);
echo "El factorial de $numero es $resultado.";
?>
