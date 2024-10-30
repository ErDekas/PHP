<?php
// Incluimos la clase Coche
include 'coche.php'; 

// Crear un objeto Coche
$coche = new Coche();

// Crear un coche para modificar
$coche1 = new Coche();
// Cambiar el color del coche a amarillo
$coche1->setColor("Amarillo");

// Acelerar 4 veces y frenar una vez
for ($i = 0; $i < 4; $i++) {
    $coche1->acelerar($coche1->getVelocidad());
}
$coche1->frenar($coche1->getVelocidad());

// Crear un nuevo coche con color verde y modelo Gallardo
$coche2 = new Coche();
$coche2->setColor("Verde");
$coche2->setModelo("Gallardo");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del Coche</title>
</head>
<body>
    <h2>Datos del coche</h2>
    <ul>
        <li>Marca: <?php echo $coche->getMarca(); ?></li>
        <li>Modelo: <?php echo $coche->getModelo(); ?></li>
        <li>Color: <?php echo $coche->getColor(); ?></li>
        <li>Caballos: <?php echo $coche->getCaballos(); ?></li>
        <li>Velocidad: <?php echo $coche->getVelocidad(); ?></li>
        <li>Plazas: <?php echo $coche->getPlazas(); ?></li>
    </ul>

    <h3>Cambiamos el color del coche y lo ponemos amarillo</h3>
    <p>El nuevo color de mi coche es: <?php echo $coche1->getColor(); ?></p>

    <h3>Mi coche va a acelerar 4 veces y a frenar una vez.</h3>
    <p>Ésta es ahora la velocidad del coche: <?php echo $coche1->getVelocidad(); ?></p>

    <h3>Creamos un nuevo coche su color será VERDE y el modelo GALLARDO</h3>
    
    <h2>Datos del NUEVO coche</h2>
    <ul>
        <li>Marca: <?php echo $coche2->getMarca(); ?></li>
        <li>Modelo: <?php echo $coche2->getModelo(); ?></li>
        <li>Color: <?php echo $coche2->getColor(); ?></li>
        <li>Caballos: <?php echo $coche2->getCaballos(); ?></li>
        <li>Velocidad: <?php echo $coche2->getVelocidad(); ?></li>
        <li>Plazas: <?php echo $coche2->getPlazas(); ?></li>
    </ul>
</body>
</html>
