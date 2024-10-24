<?php
echo "<table border='1' style='width: 100%; text-align: left;'>";

// Encabezado de la tabla
echo "<tr><th>Tabla de Multiplicar</th><th>Resultado</th></tr>";

// Bucle para las tablas de multiplicar del 1 al 10
for ($i = 1; $i <= 10; $i++) {
    for ($j = 1; $j <= 10; $j++) {
        echo "<tr>";
        echo "<td>$i x $j</td>";
        echo "<td>" . ($i * $j) . "</td>";
        echo "</tr>";
    }
}

echo "</table>";
?>
