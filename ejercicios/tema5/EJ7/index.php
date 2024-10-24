<?php
$directorio = "mi_directorio/";
if (!is_dir($directorio)) {
    mkdir($directorio);
}

// Subir archivo (puedes usar el código anterior para subir un archivo aquí)

// Mostrar archivos en el directorio
if ($gestor = opendir($directorio)) {
    while (false !== ($archivo = readdir($gestor))) {
        if ($archivo != "." && $archivo != "..") {
            echo $archivo . "<br>";
        }
    }
    closedir($gestor);
}
?>
