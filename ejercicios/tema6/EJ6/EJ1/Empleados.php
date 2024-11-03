<?php
class Empleado
{
    private $nombre;
    private $apellidos;
    private $sueldo;

    public function __construct($nombre, $apellidos, $sueldo)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->sueldo = $sueldo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getSueldo()
    {
        return $this->sueldo;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;
    }

    public function getNombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }
    public function debePagarImpuestos()
    {
        return $this->sueldo > 3333;
    }
}
