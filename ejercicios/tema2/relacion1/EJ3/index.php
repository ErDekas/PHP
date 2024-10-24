<?php
function comprobarCadena($argumento) {
    if (is_string($argumento)) {
        if (empty($argumento)) {
            return "Este es el relleno porque estaba vacía";
        } else {
            return strtoupper($argumento);
        }
    } else {
        return $argumento . " no es una cadena de caracteres";
    }
}
?>
