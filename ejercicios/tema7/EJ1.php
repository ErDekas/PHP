<?php
// Nombre de la cookie
$cookie_name = "contador_visitas";

// Verificar si el enlace para borrar la cookie ha sido clicado
if (isset($_GET['borrar'])) {
    // Borrar la cookie estableciéndola con una fecha de expiración pasada
    setcookie($cookie_name, "", time() - 3600);
    echo "La cookie ha sido borrada. <br>";
    echo '<a href="tu_pagina.php">Volver a la página principal</a>';
} else {
    // Verificar si la cookie existe
    if (isset($_COOKIE[$cookie_name])) {
        // Leer el valor de la cookie y convertirlo a entero
        $contador = (int)$_COOKIE[$cookie_name];
        $contador++; // Incrementar el contador
        echo "Bienvenido por " . $contador . " vez<br>";
    } else {
        // La cookie no existe, así que se crea con el valor inicial de 1
        $contador = 1;
        echo "Bienvenido por primera vez<br>";
    }

    // Actualizar la cookie con el nuevo valor del contador, expira en 30 días
    setcookie($cookie_name, $contador, time() + (30 * 24 * 60 * 60));

    // Enlace para borrar la cookie
    echo '<a href="?borrar=1">Borrar contador de visitas</a>';
}
?>
