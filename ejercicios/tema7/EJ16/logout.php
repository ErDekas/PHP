<?php
// Eliminar las cookies
setcookie("user_login", "", time() - 3600, "/");
setcookie("user_password", "", time() - 3600, "/");

// Redirigir al formulario de inicio de sesión
header("Location: index.php");
exit();
