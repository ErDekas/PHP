<?php
class Animal {
    protected $nombre;
    protected $edad;

    public function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    public function hacerSonido() {
        return "Sonido genérico de animal";
    }

    public function describir() {
        return "Este es un animal llamado $this->nombre y tiene $this->edad años.";
    }
}


?>