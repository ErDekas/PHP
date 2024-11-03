<?php
class Persona
{
    // Propiedades para nombre, apellidos y edad
    protected string $nombre;
    protected string $apellidos;
    protected int $edad;

    // Constructor de Persona
    public function __construct(string $nombre, string $apellidos, int $edad)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->edad = $edad;
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

    // Getter para la edad
    public function getEdad(): int
    {
        return $this->edad;
    }

    // Setter para la edad
    public function setEdad(int $edad): void
    {
        $this->edad = $edad;
    }
}
