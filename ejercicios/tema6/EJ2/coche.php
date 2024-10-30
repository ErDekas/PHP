<?php
class Coche2
{
    private $color;
    private $marca;
    private $modelo;
    private $velocidad;
    private $caballos;
    private $plazas;

    // Constructor con parámetros para los atributos esenciales
    public function __construct($marca, $modelo, $color = "Rojo")
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->color = $color;
        $this->velocidad = 300;  // Valor predeterminado
        $this->caballos = 500;   // Valor predeterminado
        $this->plazas = 2;       // Valor predeterminado
    }

    public function frenar()
    {
        $this->velocidad -= 1;
    }

    public function acelerar()
    {
        $this->velocidad += 1;
    }

    // Setters
    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setVelocidad($velocidad)
    {
        $this->velocidad = $velocidad;
    }

    // Getters
    public function getColor()
    {
        return $this->color;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getVelocidad()
    {
        return $this->velocidad;
    }

    public function getCaballos()
    {
        return $this->caballos;
    }

    public function getPlazas()
    {
        return $this->plazas;
    }
}
