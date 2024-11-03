<?php
require_once 'Persona.php';

class Empleado extends Persona
{
    private float $sueldoPorHora;
    private int $horasTrabajadas;

    // Constructor de Empleado
    public function __construct(string $nombre, string $apellidos, int $edad, float $sueldoPorHora, int $horasTrabajadas)
    {
        parent::__construct($nombre, $apellidos, $edad);
        $this->sueldoPorHora = $sueldoPorHora;
        $this->horasTrabajadas = $horasTrabajadas;
    }

    // Método para calcular el sueldo de un Empleado
    public function calcularSueldo(): float
    {
        return $this->sueldoPorHora * $this->horasTrabajadas;
    }

    // Implementación de toHtml para mostrar los detalles del empleado
    public static function toHtml(Trabajador $t): string
    {
        if (!$t instanceof Empleado) {
            throw new InvalidArgumentException("El objeto no es una instancia de Empleado.");
        }

        return "<p><strong>Nombre:</strong> " . $t->getNombreCompleto() . "<br>" .
            "<strong>Edad:</strong> " . $t->getEdad() . "<br>" .
            "<strong>Sueldo:</strong> " . $t->calcularSueldo() . "€<br>" .
            "<strong>Teléfonos:</strong> " . $t->listarTelefonos() . "</p>";
    }
}
