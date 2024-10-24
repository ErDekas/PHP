<?php
$n = 1; // Iniciamos el contador

echo "<table border='1' style='width: 50%; text-align: left;'>";
echo "<tr><th>Número</th><th>Cuadrado</th></tr>";

while ($n <= 40) {
    $cuadrado = $n * $n; // Calculamos el cuadrado del número
    echo "<tr><td>$n</td><td>$cuadrado</td></tr>"; // Mostramos el número y su cuadrado
    $n++; // Incrementamos el contador
}

echo "</table>";
?>
