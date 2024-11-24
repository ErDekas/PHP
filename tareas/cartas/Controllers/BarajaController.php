<?php

namespace Controllers;

use Models\Barajaes;

class BarajaController
{
    public function mostrarBaraja(): void
    {
        $baraja = new Barajaes();
        $baraja->barajar(); // Barajar las cartas
        $cartas = $baraja->getCartas();
        require_once './Views/baraja/muestraBaraja.php';
    }
}
