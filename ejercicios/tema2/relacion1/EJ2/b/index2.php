<?php
include "../a/index.php";
function calculador($num1, $num2, $operacion) {
    switch ($operacion) {
        case '+':
            return sumar($num1, $num2);
        case '-':
            return restar($num1, $num2);
        case '*':
            return multiplicar($num1, $num2);
        case '/':
            return dividir($num1, $num2);
        default:
            return "Operación no válida.";
    }
}

// Obtener valores de la URL
if (isset($_GET['num1']) && isset($_GET['num2']) && isset($_GET['operacion'])) {
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];
    $operacion = $_GET['operacion'];

    // Validar números
    if (is_numeric($num1) && is_numeric($num2)) {
        echo calculador($num1, $num2, $operacion);
    } else {
        echo "Ambos argumentos deben ser números.";
    }
}
?>
