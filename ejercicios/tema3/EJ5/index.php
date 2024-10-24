<?php
$animales = [];
$numAnimales = rand(20, 30);

// Generar los códigos de animales (rango Unicode 128000 a 128060)
for ($i = 0; $i < $numAnimales; $i++) {
    $codigoAnimal = rand(128000, 128060);
    $animales[] = "&#" . $codigoAnimal . ";"; // Convertir código a emoji
}

// Mostrar el grupo inicial
echo "Grupo inicial de animales:<br>";
mostrarArray($animales);

// Elegir un animal al azar
$indiceAleatorio = array_rand($animales);
$animalAleatorio = $animales[$indiceAleatorio];
echo "<br>Animal aleatorio: $animalAleatorio<br>";

// Eliminar el animal elegido del grupo
unset($animales[$indiceAleatorio]);
$animales = array_values($animales); // Reindexar el array

// Mostrar el grupo final
echo "Grupo de animales después de eliminar uno:<br>";
mostrarArray($animales);
echo "<br>Total de animales restantes: " . count($animales) . "<br>";

function mostrarArray($array) {
    foreach ($array as $valor) {
        echo $valor . " ";
    }
    echo "<br>"; // Salto de línea
}
?>
