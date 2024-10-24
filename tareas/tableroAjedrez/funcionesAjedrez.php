<?php
// Array que contiene las piezas blancas en su posición inicial
$piezasBlancas = array("torreb", "caballob", "alfilb", "reinab", "reyb", "alfilb", "caballob", "torreb");
    
// Array que contiene las piezas negras en su posición inicial
$piezasNegras = array("torren", "caballon", "alfiln", "reinan", "reyn", "alfiln", "caballon", "torren");
    
// Array que representa los peones blancos
$peonesBlancos = array_fill(0, 8, "peonb");
    
// Array que representa los peones negros
$peonesNegras = array_fill(0, 8, "peonn");
/**
 * Dibuja un tablero de ajedrez en HTML.
 *
 * Esta función genera una tabla HTML que representa un tablero de ajedrez
 * con las piezas en sus posiciones iniciales. Utiliza imágenes para las piezas
 * y aplica clases CSS para alternar los colores de las casillas.
 */
function dibujarTablero() {
    global $piezasBlancas;
    global $piezasNegras;
    global $peonesBlancos;
    global $peonesNegras;
    
    
    // Inicio de la tabla HTML
    echo "<table>";
    
    // Iteración a través de las filas del tablero
    for ($fila = 0; $fila < 8; $fila++) {
        echo "<tr>"; // Inicio de una fila
        
        // Iteración a través de las columnas del tablero
        for ($columna = 0; $columna < 8; $columna++) {
            // Determina el color de la celda (blanca o gris)
            $clase = ($fila + $columna) % 2 == 0 ? 'blanca' : 'gris';
            echo "<td class='$clase'>"; // Inicio de una celda
            
            // Coloca las piezas en su posición correspondiente
            if ($fila == 0) {
                // Piezas negras en la primera fila
                echo "<img src='images/{$piezasNegras[$columna]}.png' alt='{$piezasNegras[$columna]}'>";
            } elseif ($fila == 1) {
                // Peones negros en la segunda fila
                echo "<img src='images/{$peonesNegras[$columna]}.png' alt='{$peonesNegras[$columna]}'>";
            } elseif ($fila == 6) {
                // Peones blancos en la séptima fila
                echo "<img src='images/{$peonesBlancos[$columna]}.png' alt='{$peonesBlancos[$columna]}'>";
            } elseif ($fila == 7) {
                // Piezas blancas en la octava fila
                echo "<img src='images/{$piezasBlancas[$columna]}.png' alt='{$piezasBlancas[$columna]}'>";
            }
            
            echo "</td>"; // Fin de la celda
        }
        
        echo "</tr>"; // Fin de la fila
    }
    
    echo "</table>"; // Fin de la tabla
}
?>