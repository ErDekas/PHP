<?php
$cadena = "Hola, mundo. ¿Qué tal estás hoy?";

// Contar caracteres
$longitud = strlen($cadena);
echo "Longitud de la cadena: $longitud\n";

// Convertir a mayúsculas
$mayusculas = strtoupper($cadena);
echo "En mayúsculas: $mayusculas\n";

// Convertir a minúsculas
$minusculas = strtolower($cadena);
echo "En minúsculas: $minusculas\n";

// Reemplazar texto
$reemplazo = str_replace("mundo", "PHP", $cadena);
echo "Texto modificado: $reemplazo\n";

// Encontrar posición de una subcadena
$posicion = strpos($cadena, "¿Qué");
echo "Posición de '¿Qué': $posicion\n";
?>
