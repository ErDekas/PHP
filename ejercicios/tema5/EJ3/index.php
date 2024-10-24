<?php
$archivo = fopen("matriz.txt", 'r');
if ($archivo) {
    // Primera vuelta
    while ($linea = fscanf($archivo, "%s")) {
        print_r($linea);
    }
    
    // Volver al principio
    rewind($archivo);

    // Segunda vuelta
    while ($linea = fscanf($archivo, "%s")) {
        print_r($linea);
    }
    fclose($archivo);
}
?>
