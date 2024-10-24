<?php
$array = [];

while (count($array) < 120) {
    $array[] = rand(1, 100); // Añadiendo números aleatorios entre 1 y 100
}

echo "Contenido del array: ";
foreach ($array as $valor) {
    echo $valor . " ";
}
?>
