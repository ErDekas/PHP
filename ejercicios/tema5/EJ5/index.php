<?php
// Crear un fichero de texto
$archivo = fopen("mi_archivo.txt", 'w');
fwrite($archivo, "Línea 1\nLínea 2\nLínea 3\n");
fclose($archivo);

// Leer su contenido
$archivo = fopen("mi_archivo.txt", 'r');
while ($linea = fgets($archivo)) {
    echo $linea;
}
fclose($archivo);

// Escribir nuevo texto
$archivo = fopen("mi_archivo.txt", 'a');
fwrite($archivo, "Línea 4\n");
fclose($archivo);

// Copiar el fichero
copy("mi_archivo.txt", "mi_archivo_copia.txt");

// Renombrar el archivo
rename("mi_archivo_copia.txt", "mi_archivo_renombrado.txt");

// Eliminar el archivo renombrado
unlink("mi_archivo_renombrado.txt");
?>
