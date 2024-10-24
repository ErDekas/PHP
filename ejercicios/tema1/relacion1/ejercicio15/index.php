<?php
// Recoger los parámetros de la URL
$num1 = $_GET['num1'] ?? null;
$num2 = $_GET['num2'] ?? null;
$operacion = $_GET['operacion'] ?? null;

// Verificar que los parámetros no sean nulos
if ($num1 === null || $num2 === null || $operacion === null) {
    echo 'Error: Se requieren dos números y una operación.';
    exit;
}

// Inicializar resultado
$resultado = '';

// Realizar la operación según el parámetro "operacion"
switch ($operacion) {
    case 'suma':
        $resultado = $num1 + $num2;
        break;
    case 'resta':
        $resultado = $num1 - $num2;
        break;
    case 'multiplicacion':
        $resultado = $num1 * $num2;
        break;
    case 'division':
        if ($num2 != 0) {
            $resultado = $num1 / $num2;
        } else {
            echo 'Error: División por cero no permitida.';
            exit;
        }
        break;
    default:
        echo 'Error: Operación no válida.';
        exit;
}

// Mostrar el resultado
echo "El resultado de la operación es: " . $resultado;
?>
