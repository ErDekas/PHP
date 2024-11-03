<?php
class Persona
{
    // Propiedades para nombre y apellidos
    protected string $nombre;
    protected string $apellidos;

    // Constructor de Persona
    public function __construct(string $nombre, string $apellidos)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
    }

    // Getter para el nombre completo
    public function getNombreCompleto(): string
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

    // Getter para el nombre
    public function getNombre(): string
    {
        return $this->nombre;
    }

    // Getter para los apellidos
    public function getApellidos(): string
    {
        return $this->apellidos;
    }
}
