<?php
$archivo = fopen("fichero_existente.txt", 'r');
if ($archivo) {
    while (($caracter = fgetc($archivo)) !== false) {
        echo $caracter;
    }
    fclose($archivo);
}
?>
