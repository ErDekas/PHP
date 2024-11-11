<?php
session_start(); // Iniciamos la sesión

// Inicializamos la variable de sesión si no existe
if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 0;
}

// Comprobamos si existe el parámetro 'accion' en la URL
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    // Aumentar o disminuir el contador según el valor del parámetro
    if ($accion == '1') {
        $_SESSION['contador']++; // Incrementar en 1
    } elseif ($accion == '0') {
        $_SESSION['contador']--; // Decrementar en 1
    }
}

// Mostramos el valor actual del contador
echo "<h2>Valor del contador: " . $_SESSION['contador'] . "</h2>";

// Enlaces para aumentar o disminuir el contador
echo '<a href="?accion=1">Incrementar</a><br>';
echo '<a href="?accion=0">Disminuir</a><br>';

// Botón para reiniciar el contador
echo '<a href="?accion=reset">Reiniciar</a>';

// Opcional: Reiniciar el contador si se recibe el parámetro 'reset'
if ($accion === 'reset') {
    $_SESSION['contador'] = 0;
}
