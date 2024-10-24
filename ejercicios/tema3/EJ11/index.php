<?php
// Guardar las películas favoritas en un array
$peliculas = [
    "Los Vengadores",
    "Inception",
    "El Padrino",
    "La La Land",
    "Interstellar",
    "El Señor de los Anillos",
    "Gladiador",
    "Titanic",
    "Jurassic Park",
    "Matrix"
];

// Imprimir las películas en párrafos
foreach ($peliculas as $indice => $pelicula) {
    echo "<p style='color: " . obtenerColorAleatorio() . ";'>Película " . ($indice + 1) . ": $pelicula</p>";
}

// Mostrar las películas en una tabla
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>Posición</th><th>Película</th></tr>";

foreach ($peliculas as $indice => $pelicula) {
    echo "<tr style='background-color: " . obtenerColorAleatorio() . ";'>
    <td>" . ($indice + 1) . "</td>
    <td>$pelicula</td>
    </tr>";
}

echo "</table>";

function obtenerColorAleatorio() {
    return '#' . dechex(rand(0x000000, 0xFFFFFF));
}
?>
