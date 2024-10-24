<?php

$radio = 5;
$pi = pi();
$longitud = 2 * $pi *$radio;
$superficie = 4 * $pi * pow($radio, 2);
$volumen = (4/3) * $pi * pow($radio, 3);

$longitudRound = round($longitud, 2);
$superficieRound = round($superficie, 2);
$volumenRound = round($volumen, 2);

echo "Resultados usando round():\n";
echo "Longitud: $longitudRound\n";
echo "Superficie: $superficieRound\n";
echo "Volumen: $volumenRound\n";

echo "\nResultados usando printf():\n";
printf("Longitud: %.2f\n", $longitud);
printf("Superficie: %.2f\n", $superficie);
printf("Volumen: %.2f\n", $volumen);
?>