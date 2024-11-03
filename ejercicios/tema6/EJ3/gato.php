<?php
// Clase derivada Gato
require_once 'animal.php';

class Gato extends Animal {
    private $colorPelaje;

    public function __construct($nombre, $edad, $colorPelaje) {
        parent::__construct($nombre, $edad);
        $this->colorPelaje = $colorPelaje;
    }

    public function hacerSonido() {
        return "Miau miau!";
    }

    public function describir() {
        return "Este es un gato llamado $this->nombre, con pelaje $this->colorPelaje y tiene $this->edad años.";
    }
}
?>