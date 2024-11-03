<?php
require_once 'JSerializable.php';

abstract class Persona implements JSerializable
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

    abstract public static function toHtml(Persona $p): string;

    public function __toString(): string
    {
        return "<p><strong>Nombre:</strong> " . $this->getNombreCompleto() . "<br>" .
            "<strong>Edad:</strong> " . $this->getEdad() . "</p>";
    }

    // Implementación del método toJSON
    public function toJSON(): string
    {
        $mapa = new stdClass();
        foreach ($this as $clave => $valor) {
            $mapa->$clave = $valor;
        }
        return json_encode($mapa);
    }

    // Implementación del método toSerialize
    public function toSerialize(): string
    {
        return serialize($this);
    }
}
