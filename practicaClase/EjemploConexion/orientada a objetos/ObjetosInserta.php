<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

$conexion = new mysqli($servername, $username, $password, $dbname);

if($conexion->connect_error){
    die("La conexion ha fallado: " . $conexion->connect_error);
}

$sql = "INSERT INTO usuarios VALUES (null,'Mateo', 'mateo123', 3)";
$insert = $conexion->query($sql);

if($insert){
    echo 'Datos insertados correctamente';
    $conexion->close();
}else {
    echo "Error: ".$conexion->error;
}
?>