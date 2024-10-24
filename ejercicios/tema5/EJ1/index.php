<?php
function abrirFichero($nombre) {
    if (file_exists($nombre)) {
        $archivo = fopen($nombre, 'r');
        if ($archivo) {
            echo "Fichero abierto con éxito.";
            fclose($archivo);
        }
    } else {
        echo "Error: El fichero '$nombre' no existe.";
    }
}

// Ejemplos
abrirFichero("fichero_existente.txt");
abrirFichero("fichero_no_existente.txt");
?>
