<?php
// Simulamos la tirada de dos dados
$dado1 = rand(1, 6);
$dado2 = rand(1, 6);

// Mostramos los resultados de la tirada
echo "Dado 1: $dado1<br>";
echo "Dado 2: $dado2<br>";

// Verificamos si ha salido una pareja
if ($dado1 === $dado2) {
    echo "¡Ha salido una pareja de valores iguales!<br>";
} else {
    echo "No ha salido una pareja.<br>";
}

// Determinamos el mayor de los valores
$mayor = max($dado1, $dado2);
echo "El mayor de los valores es: $mayor<br>";
?>
