<?php
$cadena = "¡Hola, mundo! ñáéíóú";

$longitud = mb_strlen($cadena);

$cadena_invertida = '';

for ($i = $longitud - 1; $i >= 0; $i--) {
    $caracter = mb_substr($cadena, $i, 1);
    $cadena_invertida .= $caracter;
}

echo $cadena_invertida;
?>
