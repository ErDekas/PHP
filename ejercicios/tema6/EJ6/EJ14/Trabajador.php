<?php
abstract class Trabajador
{
    protected string $nombre;
    protected string $apellidos;
    protected int $edad;

    public function __construct(string $nombre, string $apellidos, int $edad)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->edad = $edad;
    }

    public function getNombreCompleto(): string
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

    public function getEdad(): int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): void
    {
        $this->edad = $edad;
    }

    abstract public function calcularSueldo(): float; // Método abstracto

    abstract public static function toHtml(Trabajador $t): string; // Método abstracto

    public function __toString(): string
    {
        return "<p><strong>Nombre:</strong> " . $this->getNombreCompleto() . "<br>" .
            "<strong>Edad:</strong> " . $this->getEdad() . "</p>";
    }
}
