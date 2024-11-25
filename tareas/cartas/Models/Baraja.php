<?php

class Baraja {
    private $cartas;

    public function __construct() {
        if (!isset($_SESSION['cartas'])) {
            $this->generarBaraja();
        } else {
            $this->cartas = $_SESSION['cartas'];
        }
    }

    private function generarBaraja() {
        $palos = ['bastos', 'copas', 'espadas', 'oros'];
        $this->cartas = [];

        foreach ($palos as $palo) {
            for ($i = 1; $i <= 12; $i++) {
                    $this->cartas[] = "{$palo}_{$i}";
            }
        }
        shuffle($this->cartas); // Mezclar al inicializar
        $_SESSION['cartas'] = $this->cartas;
    }

    public function obtenerCartas() {
        return $this->cartas;
    }

    public function barajar() {
        $this->generarBaraja(); // Regenera la baraja y la mezcla
        return $this->cartas;
    }

    public function sacarCarta() {
        if (count($this->cartas) > 0) {
            $carta = array_pop($this->cartas); // Sacar la última carta
            $_SESSION['cartas'] = $this->cartas; // Actualizar la baraja en la sesión
            return $carta;
        }
        return null; // No quedan cartas
    }
    

    public function repartir($jugadores, $cartasPorJugador) {
        $reparto = [];
    
        for ($i = 0; $i < $jugadores; $i++) {
            $reparto[$i] = [];
        }
    
        for ($j = 0; $j < $cartasPorJugador; $j++) {
            for ($i = 0; $i < $jugadores; $i++) {
                if (count($this->cartas) > 0) {
                    $reparto[$i][] = array_pop($this->cartas);
                }
            }
        }
    
        $_SESSION['cartas'] = $this->cartas; // Actualiza la sesión
        return $reparto;
    }
    
}
