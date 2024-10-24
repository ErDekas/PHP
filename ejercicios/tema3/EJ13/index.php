<?php
// Definición de la baraja
/**
 * @var array $palos Lista de los palos de la baraja.
 */
$palos = ['oros', 'copas', 'espadas', 'bastos'];

/**
 * @var array $figuras Lista de las figuras de la baraja.
 */
$figuras = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

/**
 * @var array $baraja Baraja completa generada a partir de los palos y figuras.
 */
$baraja = [];

// Generación de la baraja
foreach ($palos as $palo) {
    foreach ($figuras as $figura) {
        $baraja[] = "$figura de $palo";
    }
}

/**
 * Reparte un número específico de cartas de la baraja sin repetir.
 *
 * @param array &$baraja La baraja de cartas de la cual se repartirán las cartas. Se modifica directamente.
 * @param int $numCartas El número de cartas a repartir.
 * @return array Las cartas repartidas.
 */
function repartirCartas(&$baraja, $numCartas) {
    $cartasRepartidas = [];
    while (count($cartasRepartidas) < $numCartas) {
        $indiceAleatorio = array_rand($baraja);
        $cartasRepartidas[] = $baraja[$indiceAleatorio];
        unset($baraja[$indiceAleatorio]); // Eliminar la carta de la baraja
        $baraja = array_values($baraja); // Reindexar el array
    }
    return $cartasRepartidas;
}

// a) Repartir 3 cartas al jugador
/**
 * @var array $barajaOriginal Copia de la baraja original para repartir más cartas.
 */
$barajaOriginal = $baraja; // Hacer una copia de la baraja original

/**
 * @var array $cartasJugador Cartas repartidas al jugador.
 */
$cartasJugador = repartirCartas($baraja, 3);

// b) Repartir 10 cartas para la baza
/**
 * @var array $cartasBaza Cartas repartidas para la baza.
 */
$cartasBaza = repartirCartas($barajaOriginal, 10); // Repartir de la baraja original

// Definición de puntos para las figuras
/**
 * @var array $puntos Puntos asignados a cada figura de la baraja.
 */
$puntos = [
    '1' => 11,
    '3' => 10,
    '2' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0,
    '10' => 2, '11' => 3, '12' => 4,
];

// Calcular puntos de la baza
/**
 * @var int $sumaPuntos Suma total de puntos obtenidos en la baza.
 */
$sumaPuntos = 0;
foreach ($cartasBaza as $carta) {
    $figura = explode(' de ', $carta)[0]; // Obtener la figura de la carta
    if (isset($puntos[$figura])) {
        $sumaPuntos += $puntos[$figura];
    }
}

// Mostrar cartas del jugador
echo "<h3>Cartas repartidas al jugador:</h3><div style='display:flex;'>";
foreach ($cartasJugador as $carta) {
    $palo = explode(' de ', $carta)[1]; // Obtener el palo
    $imagen = "{$palo}_{$figura}.jpg"; // Formato de la imagen
    echo "<img src='./imagenes/{$imagen}' alt='$carta' style='width:100px; margin:5px;'>";
}
echo "</div>";

// Mostrar cartas de la baza y total de puntos
echo "<h3>Cartas en la baza:</h3><div style='display:flex;'>";
foreach ($cartasBaza as $carta) {
    $palo = explode(' de ', $carta)[1]; // Obtener el palo
    $figura = explode(' de ', $carta)[0]; // Obtener la figura
    $imagen = "{$palo}_{$figura}.jpg"; // Formato de la imagen
    echo "<img src='./imagenes/{$imagen}' alt='$carta' style='width:100px; margin:5px;'>";
}
echo "</div>";

echo "<h3>Total de puntos en la baza: $sumaPuntos</h3>";
?>