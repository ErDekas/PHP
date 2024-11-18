<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

$conexion = new mysqli($servername, $username, $password, $dbname);

if($conexion->connect_error){
    die("La conexion ha fallado: " . $conexion->connect_error);
}
$sql = "SELECT * FROM usuarios";

if($resultado = $conexion->query($sql)){
    while($obj = $resultado->fetch_object()){
        echo "Codigo: " . $obj->codigo . " , Nombre: " . $obj->nombre . " , Rol: " . $obj->rol."<br>";
    }
    $conexion->close();
} else {
    echo "No hay registros";
}
?>