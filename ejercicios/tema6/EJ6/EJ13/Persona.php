<?php
abstract class Persona extends Trabajador
{
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

    // Getter para la edad
    public function getEdad(): int
    {
        return $this->edad;
    }

    // Método mágico __toString() para mostrar las propiedades básicas de Persona
    public function __toString(): string
    {
        return "<p><strong>Nombre:</strong> " . $this->getNombreCompleto() . "<br>" .
            "<strong>Edad:</strong> " . $this->getEdad() . "</p>";
    }
}
