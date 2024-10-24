<?php
// Crear un array con 15 números aleatorios
$array = [];
for ($i = 0; $i < 15; $i++) {
    $array[] = rand(1, 100); // Números aleatorios entre 1 y 100
}

// Mostrar el array original
echo "Array original: ";
mostrarArray($array);

// Rotar los elementos del array
$primerElemento = array_shift($array); // Quitar el primer elemento
$array[] = $primerElemento; // Añadirlo al final

// Mostrar el nuevo array
echo "Array después de rotar: ";
mostrarArray($array);

function mostrarArray($array) {
    foreach ($array as $valor) {
        echo $valor . " ";
    }
    echo "<br>"; // Salto de línea
}
?>