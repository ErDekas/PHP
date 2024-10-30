<?php
class Coche3 {
    // Constructor con promoción de propiedades en PHP 8
    public function __construct(
        private string $marca,
        private string $modelo,
        private string $color = "Rojo",
        private int $velocidad = 300,
        private int $caballos = 500,
        private int $plazas = 2
    ) {}

    public function frenar() {
        $this->velocidad -= 1;
    }

    public function acelerar() {
        $this->velocidad += 1;
    }

    // Getters
    public function getColor() {
        return $this->color;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getVelocidad() {
        return $this->velocidad;
    }

    public function getCaballos() {
        return $this->caballos;
    }

    public function getPlazas() {
        return $this->plazas;
    }
}
?>
