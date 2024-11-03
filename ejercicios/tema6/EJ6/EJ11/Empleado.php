<?php
require_once 'Persona.php';

class Empleado extends Persona
{
    private float $sueldo;
    private array $telefonos = [];
    private static float $sueldoTope = 3333;

    public function __construct(string $nombre, string $apellidos, int $edad, float $sueldo = 1000)
    {
        parent::__construct($nombre, $apellidos, $edad);
        $this->sueldo = $sueldo;
    }

    public function getSueldo(): float
    {
        return $this->sueldo;
    }

    public function setSueldo(float $sueldo): void
    {
        $this->sueldo = $sueldo;
    }

    public function anyadirTelefono(int $telefono): void
    {
        $this->telefonos[] = $telefono;
    }

    public function listarTelefonos(): string
    {
        return implode(', ', $this->telefonos);
    }

    public function vaciarTelefonos(): void
    {
        $this->telefonos = [];
    }

    public function debePagarImpuestos(): bool
    {
        return $this->edad > 21 && $this->sueldo > self::$sueldoTope;
    }

    // Implementación de toHtml para cumplir con el método abstracto de Persona
    public static function toHtml(Persona $p): string
    {
        if (!$p instanceof Empleado) {
            throw new InvalidArgumentException("El objeto no es una instancia de Empleado.");
        }

        $telefonosListado = empty($p->telefonos) ? "Ninguno" : implode(", ", $p->telefonos);

        return "<p><strong>Nombre:</strong> " . $p->getNombreCompleto() . "<br>" .
            "<strong>Edad:</strong> " . $p->getEdad() . "<br>" .
            "<strong>Sueldo:</strong> " . $p->getSueldo() . "€<br>" .
            "<strong>Teléfonos:</strong> " . $telefonosListado . "<br>" .
            "<strong>Debe pagar impuestos:</strong> " . ($p->debePagarImpuestos() ? "Sí" : "No") . "</p>";
    }

    public function __toString(): string
    {
        $telefonosListado = empty($this->telefonos) ? "Ninguno" : implode(", ", $this->telefonos);

        return parent::__toString() .
            "<p><strong>Sueldo:</strong> " . $this->getSueldo() . "€</p>" .
            "<p><strong>Teléfonos:</strong> " . $telefonosListado . "</p>" .
            "<p><strong>Debe pagar impuestos:</strong> " . ($this->debePagarImpuestos() ? "Sí" : "No") . "</p>";
    }
}
