<?php
require_once 'Persona.php';

class Empleado extends Persona
{
    private float $sueldo;
    private array $telefonos = [];
    private static float $sueldoTope = 3333; // Límite de sueldo para pagar impuestos

    // Constructor de Empleado
    public function __construct(string $nombre, string $apellidos, int $edad, float $sueldo = 1000)
    {
        parent::__construct($nombre, $apellidos, $edad);
        $this->sueldo = $sueldo;
    }

    // Getter y setter para el sueldo
    public function getSueldo(): float
    {
        return $this->sueldo;
    }

    public function setSueldo(float $sueldo): void
    {
        $this->sueldo = $sueldo;
    }

    // Método para añadir un teléfono al array
    public function anyadirTelefono(int $telefono): void
    {
        $this->telefonos[] = $telefono;
    }

    // Método para listar los teléfonos separados por comas
    public function listarTelefonos(): string
    {
        return implode(', ', $this->telefonos);
    }

    // Método para vaciar la lista de teléfonos
    public function vaciarTelefonos(): void
    {
        $this->telefonos = [];
    }

    // Método que calcula si el empleado debe pagar impuestos
    public function debePagarImpuestos(): bool
    {
        return $this->edad > 21 && $this->sueldo > self::$sueldoTope;
    }

    // Método requerido para calcular el sueldo
    public function calcularSueldo(): float
    {
        return $this->sueldo;  // Ejemplo básico; se podría cambiar según necesidad
    }

    // Implementación del método toHtml, cumpliendo la firma de Persona
    public static function toHtml(Persona $p): string
    {
        if (!$p instanceof Empleado) {
            throw new InvalidArgumentException("El objeto no es una instancia de Empleado.");
        }

        $telefonosListado = empty($p->telefonos) ? "Ninguno" : "<ol><li>" . implode("</li><li>", $p->telefonos) . "</li></ol>";

        return "<p><strong>Nombre:</strong> " . $p->getNombreCompleto() . "<br>" .
            "<strong>Edad:</strong> " . $p->getEdad() . "<br>" .
            "<strong>Sueldo:</strong> " . $p->getSueldo() . "€</p>" .
            "<p><strong>Telefonos:</strong> " . $telefonosListado . "</p>" .
            "<p><strong>Debe pagar impuestos:</strong> " . ($p->debePagarImpuestos() ? "Sí" : "No") . "</p>";
    }

    // Método mágico __toString()
    public function __toString(): string
    {
        $telefonosListado = empty($this->telefonos) ? "Ninguno" : "<ol><li>" . implode("</li><li>", $this->telefonos) . "</li></ol>";

        return parent::__toString() .
            "<p><strong>Sueldo:</strong> " . $this->getSueldo() . "€</p>" .
            "<p><strong>Telefonos:</strong> " . $telefonosListado . "</p>" .
            "<p><strong>Debe pagar impuestos:</strong> " . ($this->debePagarImpuestos() ? "Sí" : "No") . "</p>";
    }
}
