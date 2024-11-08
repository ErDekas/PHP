<?php
session_start();  // Iniciar sesión

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir a la página de login
echo("Has cerrado sesión.");
sleep(5);
header("Location: login.php");
exit();
?>
