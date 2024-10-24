<?php
// Array de 8 números enteros
$numeros = [12, 5, 8, 3, 20, 15, 7, 10];

// Función para mostrar el array
function mostrarArray($array) {
    foreach ($array as $numero) {
        echo $numero . " ";
    }
    echo "<br>"; // Salto de línea
}

// a. Mostrar el array original
echo "Array original: ";
mostrarArray($numeros);

// b. Ordenar y mostrar el array
sort($numeros);
echo "Array ordenado: ";
mostrarArray($numeros);

// c. Mostrar la longitud del array
echo "Longitud del array: " . count($numeros) . "<br>";

// d. Buscar un elemento específico
$elementoABuscar = 10; // Cambia este valor para probar
if (in_array($elementoABuscar, $numeros)) {
    echo "El elemento $elementoABuscar está en el array.<br>";
} else {
    echo "El elemento $elementoABuscar no está en el array.<br>";
}

// e. Buscar un elemento por parámetro en la URL
if (isset($_GET['buscar'])) {
    $elementoABuscarUrl = intval($_GET['buscar']);
    if (in_array($elementoABuscarUrl, $numeros)) {
        echo "El elemento $elementoABuscarUrl está en el array (buscado por URL).<br>";
    } else {
        echo "El elemento $elementoABuscarUrl no está en el array (buscado por URL).<br>";
    }
}
?>
