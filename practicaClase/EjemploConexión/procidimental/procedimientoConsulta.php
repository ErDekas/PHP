<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empresa";

$conexion = mysqli_connect($servername, $username, $password, $dbname);

if(!$conexion) {
    die("La conexion ha fallado: " . mysqli_connect_error());
}
$sql = "SELECT * FROM usuarios";
$query = mysqli_query($conexion, $sql);

if(mysqli_num_rows($query)>0){
    while($row = mysqli_fetch_assoc($query)){
        echo "Codigo: " . $row["codigo"] . " , Nombre: " . $row["nombre"] . " , Rol: " . $row["rol"]."<br>";
    }
} else {
    echo "No hay registros";
}
?>