<?php
require_once 'Persona.php';

class Gerente extends Persona
{
    private float $salarioBase;

    // Constructor de Gerente
    public function __construct(string $nombre, string $apellidos, int $edad, float $salarioBase)
    {
        parent::__construct($nombre, $apellidos, $edad);
        $this->salarioBase = $salarioBase;
    }

    // Método para calcular el sueldo del Gerente considerando un incremento porcentual basado en la edad
    public function calcularSueldo(): float
    {
        return $this->salarioBase * (1 + $this->edad / 100);
    }

    // Implementación de toHtml para mostrar los detalles del gerente
    public static function toHtml(Trabajador $t): string
    {
        if (!$t instanceof Gerente) {
            throw new InvalidArgumentException("El objeto no es una instancia de Gerente.");
        }

        return "<p><strong>Nombre:</strong> " . $t->getNombreCompleto() . "<br>" .
            "<strong>Edad:</strong> " . $t->getEdad() . "<br>" .
            "<strong>Sueldo:</strong> " . $t->calcularSueldo() . "€<br>" .
            "<strong>Teléfonos:</strong> " . $t->listarTelefonos() . "</p>";
    }
}
