<?php
// Recoger los parámetros de la URL
$num1 = $_GET['num1'] ?? null;
$num2 = $_GET['num2'] ?? null;

// Verificar que los parámetros no sean nulos y que num1 sea menor que num2
if ($num1 === null || $num2 === null) {
    echo 'Error: Se requieren dos números.';
    exit;
}

if ($num1 >= $num2) {
    echo 'Error: El primer número debe ser menor que el segundo.';
    exit;
}

// Mostrar los números impares comprendidos entre num1 y num2
$resultados = [];
for ($i = $num1 + 1; $i < $num2; $i++) {
    if ($i % 2 != 0) { // Comprobar si el número es impar
        $resultados[] = $i;
    }
}

// Mostrar los resultados
if (empty($resultados)) {
    echo 'No hay números impares entre ' . $num1 . ' y ' . $num2 . '.';
} else {
    echo 'Números impares entre ' . $num1 . ' y ' . $num2 . ': ' . implode(', ', $resultados) . '.';
}
?>
