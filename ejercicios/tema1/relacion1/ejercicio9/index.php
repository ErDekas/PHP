<?php
// Definimos los números y sus traducciones
$numeros = [
    1 => ['one', 'uno'],
    2 => ['two', 'dos'],
    3 => ['three', 'tres'],
    4 => ['four', 'cuatro'],
    5 => ['five', 'cinco'],
    6 => ['six', 'seis'],
    7 => ['seven', 'siete'],
    8 => ['eight', 'ocho'],
    9 => ['nine', 'nueve'],
    10 => ['ten', 'diez']
];

// Generamos la tabla HTML
echo "<table border='1' style='width: 50%; text-align: left;'>";
echo "<tr><th>Número (Inglés)</th><th>Número (Español)</th></tr>";

foreach ($numeros as $numero => $nombres) {
    echo "<tr>";
    echo "<td>" . $nombres[0] . "</td>";
    echo "<td>" . $nombres[1] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
