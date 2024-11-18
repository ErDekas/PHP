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
$query = $conexion->query($sql);

if(mysqli_num_rows($query)>0){
    while($row = $query->fetch_assoc()){
        echo "Codigo: " . $row["codigo"] . " , Nombre: " . $row["nombre"] . " , Rol: " . $row["rol"]."<br>";
    }
    $conexion->close();
} else {
    echo "No hay registros";
}
?>