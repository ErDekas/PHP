<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

// Desactivar toda notificacion de error

error_reporting(0);
mysqli_report(MYSQLI_REPORT_OFF);

// Creamos la conexion
$conexion = new mysqli($servername, $username, $password, $dbname);

// Comprobamos la conexion
if($conexion->connect_error){
    die("La conexion ha fallado: " . mysqli_connect_error());
}

echo "<h2>Conexion establecida con exito</h2>";
mysqli_close($conexion);
?>