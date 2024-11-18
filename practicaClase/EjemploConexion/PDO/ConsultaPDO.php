<?php
require_once 'config.php';

try {
    $bd = new PDO("mysql:host=". SERVERNAME .";dbname=".DBNAME, USERNAME, PASSWORD);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{
        $stmt = $bd->query("SELECT * FROM usuarios");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        foreach ($stmt->fetchAll() as $row){
            echo "Nombre: " . $row['nombre'] . ", Rol: " .$row['rol'] . "<br>";
        }
    }catch(PDOException $e){
        echo "Error: ejecutando consulta SQL";
    }
}catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>