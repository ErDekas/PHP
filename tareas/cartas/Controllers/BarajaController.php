<?php
require_once 'models/Baraja.php';

class BarajaController {
    public function mostrar() {
        $baraja = new Baraja();
        $cartas = $baraja->obtenerCartas();
        require_once 'views/baraja/mostrar.php';
    }

    public function mostrarCarta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $palo = $_POST['palo'];
            $numero = $_POST['numero'];
            $carta = "{$palo}_{$numero}";
            require_once 'views/baraja/mostrarCarta.php';
        } else {
            require_once 'views/baraja/formCarta.php';
        }
    }

    public function barajar() {
        $baraja = new Baraja();
        $cartas = $baraja->barajar();
        require_once 'views/baraja/mostrar.php';
    }

    public function sacar() {
        $baraja = new Baraja();
        $carta = $baraja->sacarCarta(); // Saca una carta del modelo
        require_once 'views/baraja/sacar.php';
    }
    

    public function repartir() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jugadores = intval($_POST['jugadores']);
            $cartasPorJugador = intval($_POST['cartas']);
    
            $baraja = new Baraja();
            $reparto = $baraja->repartir($jugadores, $cartasPorJugador);
            
            require_once 'views/baraja/repartir.php';
        } else {
            require_once 'views/baraja/formRepartir.php';
        }
    }
    
}
