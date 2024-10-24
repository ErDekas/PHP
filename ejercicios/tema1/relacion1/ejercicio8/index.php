<?php
$base = 9;
$altura = $base+1/2;

for ($i = 0; $i < $altura; $i++) {
    // Imprimir espacios
    for ($j = 0; $j < $altura - $i - 1; $j++) {
        echo '&nbsp;';
    }
    // Imprimir asteriscos
    if ($i == $base) {
        // En la última fila, imprimir todos los asteriscos
        for ($k = 0; $k <= 1 * $i + 1; $k++) {
            echo '*';
        }
    } else {
        // En las filas intermedias, imprimir solo los asteriscos en los extremos
        echo '*';
        for ($k = 0; $k < 2 * $i - 1; $k++) {
            echo '&nbsp;';
        }
        if ($i > 0) {
            echo '*';
        }
    }
    echo "<br>";
}
?>
