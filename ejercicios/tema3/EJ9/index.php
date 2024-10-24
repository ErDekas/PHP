<?php
$provincias = ["Sevilla", "Málaga", "Córdoba", "Granada", "Jaén", "Almería", "Cádiz", "Huelva"];

// Borrar el elemento de índice 2
unset($provincias[2]);

// Mostrar el array después de borrar
echo "Provincias de Andalucía después de borrar un elemento:<br>";
mostrarArray($provincias);

function mostrarArray($array) {
    foreach ($array as $valor) {
        echo $valor . "<br>";
    }
}
?>
