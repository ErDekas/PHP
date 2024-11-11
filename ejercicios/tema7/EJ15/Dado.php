<?php
class Dado
{
    private $caras = ['AS', 'K', 'Q', 'J', 'roja', 'negra'];
    private $ultimaFigura;

    // Método para tirar el dado
    public function tira()
    {
        $this->ultimaFigura = $this->caras[array_rand($this->caras)];
    }

    // Método para obtener el nombre de la figura
    public function nombreFigura()
    {
        return $this->ultimaFigura;
    }
}
