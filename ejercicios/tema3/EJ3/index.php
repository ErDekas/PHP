<?php
$array = [];
$longitud = 10; // Puedes cambiar la longitud si deseas

// Rellenar el array con 0s y 1s aleatorios
for ($i = 0; $i < $longitud; $i++) {
    $array[] = rand(0, 1);
}

// Calcular el complementario
$complementario = array_map(function($valor) {
    return $valor === 0 ? 1 : 0;
}, $array);

// Mostrar el array original y su complementario
echo "Array original: ";
mostrarArray($array);
echo "Complementario: ";
mostrarArray($complementario);

function mostrarArray($array) {
    foreach ($array as $valor) {
        echo $valor . " ";
    }
    echo "<br>"; // Salto de línea
}
?>
