<?php
// Configuración de la base de datos
class DatabaseConfig {
    private static $host = 'localhost';
    private static $dbname = 'belleza';
    private static $username = 'root';
    private static $password = '';
    private static $charset = 'utf8mb4';

    public static function getConnection() {
        // Crear la conexión a MySQLi
        $conexion = new mysqli(self::$host, self::$username, self::$password, self::$dbname);
        
        // Verificar si hubo un error de conexión
        if ($conexion->connect_error) {
            error_log("Error de conexión: " . $conexion->connect_error);
            throw new Exception("No se pudo conectar a la base de datos");
        }

        // Establecer el conjunto de caracteres para la conexión
        if (!$conexion->set_charset(self::$charset)) {
            error_log("Error al establecer el conjunto de caracteres: " . $conexion->error);
            throw new Exception("Error al establecer el conjunto de caracteres");
        }

        return $conexion;
    }

    // Método para cerrar la conexión
    public static function closeConnection(&$conexion) {
        if ($conexion) {
            $conexion->close();
        }
    }
}
?>
