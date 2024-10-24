<?php
// Función para calcular el MCD
function mcd($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

// Programa para probar la función MCD
$num1 = 48;
$num2 = 18;
$resultadoMCD = mcd($num1, $num2);
echo "El MCD de $num1 y $num2 es: $resultadoMCD\n";
?>
