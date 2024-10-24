<?php
function duplicarCaracteres($cadena) {
    return implode('', array_map(function($char) {
        return $char . $char;
    }, str_split($cadena)));
}

// Programa para probar
$cadena = "Hola";
echo duplicarCaracteres($cadena);
?>
