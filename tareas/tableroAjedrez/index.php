<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Tablero de Ajedrez</title> <!-- Título de la página que aparece en la pestaña del navegador -->
    <link rel="stylesheet" href="styles.css"> <!-- Enlace a la hoja de estilos CSS externa -->
</head>
<body>
    <h1>Tablero de Ajedrez</h1> <!-- Título principal de la página -->
    
    <?php
    // Incluye el archivo de funciones PHP que contiene la función para dibujar el tablero
    include "funcionesAjedrez.php";
    
    // Llama a la función que dibuja el tablero de ajedrez
    dibujarTablero();
    ?>
</body>
</html>