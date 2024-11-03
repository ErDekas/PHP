<?php
abstract class Trabajador
{
    protected array $telefonos = [];

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

    // Método abstracto para calcular el sueldo, a implementar en las clases hijas
    abstract public function calcularSueldo(): float;

    // Método abstracto toHtml que debe implementarse en las clases hijas
    abstract public static function toHtml(Trabajador $t): string;
}
