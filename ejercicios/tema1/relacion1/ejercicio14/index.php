<?php
echo "<table border='1' style='width: 50%; text-align: left;'>";

// Encabezado de la tabla
echo "<tr>
        <th>Número Decimal</th>
        <th>Número Binario</th>
        <th>Número Octal</th>
        <th>Número Hexadecimal</th>
      </tr>";

// Bucle para los primeros 20 números
for ($i = 1; $i <= 20; $i++) {
    echo "<tr>";
    printf("<td>%02d</td>", $i);                   // Número en decimal
    printf("<td>%b</td>", $i);                   // Número en binario
    printf("<td>%o</td>", $i);                   // Número en octal
    printf("<td>%X</td>", $i);                   // Número en hexadecimal
    echo "</tr>";
}

echo "</table>";
?>