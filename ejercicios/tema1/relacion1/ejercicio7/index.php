<?php
$base = 9;
$altura = ($base+1)/2;

for ($i = 0; $i < $altura; $i++) {
    // Imprimir espacios
    for ($j = 0; $j < $altura - $i - 1; $j++) {
        echo ' &nbsp;';
    }
    // Imprimir asteriscos
    for ($k = 0; $k < 2 * $i + 1; $k++) {
        echo '*';
    }
    echo "<br>";
}
?>