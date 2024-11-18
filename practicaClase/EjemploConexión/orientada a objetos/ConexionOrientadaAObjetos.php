<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

error_reporting(0);
mysqli_report(MYSQLI_REPORT_OFF);

$conexion = new Mysqli($servername, $username, $password, $dbname);
// connect_errno: Devuelve el numero del error
// connect_error: Devuelve el error de la ultima consulta
if($conexion->connect_errno){
    die("La conexion ha fallado: " . $conexion->connect_error);
}else {
    echo "<h2>Conexion realizada correctamente<h2>";
    $conexion->close();
}
?>