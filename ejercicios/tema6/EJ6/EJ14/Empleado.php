<?php
require_once 'Trabajador.php'; // Asegúrate de incluir la clase abstracta

class Empleado extends Trabajador
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

    public function calcularSueldo(): float
    {
        return $this->sueldo; // Retorna el sueldo base del empleado
    }

    public static function toHtml(Trabajador $t): string
    {
        if (!$t instanceof Empleado) {
            throw new InvalidArgumentException("El objeto no es una instancia de Empleado.");
        }

        $telefonosListado = empty($t->telefonos) ? "Ninguno" : implode(", ", $t->telefonos);

        return "<p><strong>Nombre:</strong> " . $t->getNombreCompleto() . "<br>" .
            "<strong>Edad:</strong> " . $t->getEdad() . "<br>" .
            "<strong>Sueldo:</strong> " . $t->calcularSueldo() . "€<br>" .
            "<strong>Teléfonos:</strong> " . $telefonosListado . "<br>" .
            "<strong>Debe pagar impuestos:</strong> " . ($t->debePagarImpuestos() ? "Sí" : "No") . "</p>";
    }

    public function __toString(): string
    {
        $telefonosListado = empty($this->telefonos) ? "Ninguno" : implode(", ", $this->telefonos);

        return parent::__toString() .
            "<p><strong>Sueldo:</strong> " . $this->calcularSueldo() . "€</p>" .
            "<p><strong>Teléfonos:</strong> " . $telefonosListado . "</p>" .
            "<p><strong>Debe pagar impuestos:</strong> " . ($this->debePagarImpuestos() ? "Sí" : "No") . "</p>";
    }
}
