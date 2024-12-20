<?php
// Archivo: Persona.php
abstract class Persona
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

    // Getter y setter para la edad
    public function getEdad(): int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): void
    {
        $this->edad = $edad;
    }

    // Método mágico __toString() para mostrar las propiedades
    public function __toString(): string
    {
        return "<p><strong>Nombre:</strong> " . $this->getNombreCompleto() . "<br>" .
            "<strong>Edad:</strong> " . $this->getEdad() . "</p>";
    }

    // Método abstracto toHtml que debe implementarse en las clases hijas
    abstract public static function toHtml(Persona $p): string;
}
