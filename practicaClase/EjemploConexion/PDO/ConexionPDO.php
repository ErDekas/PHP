<?php
require_once 'config.php';

try {
    // Crear conexión usando PDO
    $conexion = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DBNAME, USERNAME, PASSWORD);

    // Configurar el modo de error para PDO
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<h2>Conexión realizada correctamente</h2>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
