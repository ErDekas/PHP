<?php
// Clase derivada Perro
require_once 'animal.php';

class Perro extends Animal {
    private $raza;

    public function __construct($nombre, $edad, $raza) {
        parent::__construct($nombre, $edad);
        $this->raza = $raza;
    }

    public function hacerSonido() {
        return "Guau guau!";
    }

    public function describir() {
        return "Este es un perro llamado $this->nombre, de la raza $this->raza y tiene $this->edad años.";
    }
}
?>