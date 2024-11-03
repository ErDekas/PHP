<?php
// Clase derivada Pajaro
require_once 'Animal.php';

class Pajaro extends Animal {
    private $especie;

    public function __construct($nombre, $edad, $especie) {
        parent::__construct($nombre, $edad);
        $this->especie = $especie;
    }

    public function hacerSonido() {
        return "Pío pío!";
    }

    public function describir() {
        return "Este es un pájaro llamado $this->nombre, de la especie $this->especie y tiene $this->edad años.";
    }
}
?>