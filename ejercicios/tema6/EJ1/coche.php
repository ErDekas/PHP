<?php
class Coche
{
    private $color = "Rojo";
    private $marca = "Ferrari";
    private $modelo = "Aventador";
    private $velocidad = 300;
    private $caballos = 500;
    private $plazas = 2;

    public function frenar($velocidad)
    {
        $this->velocidad = $velocidad - 1;
    }
    public function acelerar($velocidad)
    {
        $this->velocidad = $velocidad + 1;
    }
    // Setters
    public function setColor($color)
    {
        $this->color = $color;
    }
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }
    public function setVelocidad($velocidad)
    {
        $this->velocidad = $velocidad;
    }
    public function setCaballos($caballos)
    {
        $this->caballos = $caballos;
    }
    public function setPlazas($plazas)
    {
        $this->plazas = $plazas;
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
