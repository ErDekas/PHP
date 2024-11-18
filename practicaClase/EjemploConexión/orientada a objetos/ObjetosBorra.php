<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

$conexion = new mysqli($servername, $username, $password, $dbname);

if($conexion->connect_error){
    die("La conexion ha fallado: " . $conexion->connect_error);
}
$sql = "DELETE FROM usuarios WHERE nombre = 'Mateo'";
$delete = $conexion->query($sql);

if($delete){
    echo "Datos borrados correctamente";
} else {
    echo "Error: ".$conexion->connect_error;
}
?>