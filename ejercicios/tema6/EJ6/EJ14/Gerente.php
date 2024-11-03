<?php
require_once 'Empleado.php'; // Asegúrate de incluir la clase Empleado

class Gerente extends Empleado
{
    public function calcularSueldo(): float
    {
        return $this->getSueldo() + ($this->getSueldo() * $this->getEdad() / 100); // Incremento según la edad
    }

    public static function toHtml(Trabajador $t): string
    {
        return "<p><strong>Gerente:</strong> " . parent::toHtml($t) . "</p>";
    }

    public function __toString(): string
    {
        return "<strong>Gerente:</strong> " . parent::__toString();
    }
}
