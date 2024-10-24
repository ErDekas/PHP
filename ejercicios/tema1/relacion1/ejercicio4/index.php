<?php
$tasa_cambio = 1.12;

$euros = 100;

$dolares = $euros * $tasa_cambio;

echo "$euros € equivale a $dolares $ "; 
printf("%.2feuros € equivale  %.2fdolares $",$euros,$dolares);
?>