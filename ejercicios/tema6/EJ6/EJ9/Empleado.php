<?php
require_once 'Persona.php';

class Empleado extends Persona
{
    private float $sueldo;
    private array $telefonos = [];
    private static float $sueldoTope = 3333; // Variable estática para el límite de impuestos

    // Constructor de Empleado
    public function __construct(string $nombre, string $apellidos, int $edad, float $sueldo = 1000)
    {
        parent::__construct($nombre, $apellidos, $edad); // Llamada al constructor de Persona
        $this->sueldo = $sueldo;
    }

    // Getter para sueldo
    public function getSueldo(): float
    {
        return $this->sueldo;
    }

    // Setter para sueldo
    public function setSueldo(float $sueldo): void
    {
        $this->sueldo = $sueldo;
    }

    // Método para comprobar si debe pagar impuestos: edad mayor a 21 y sueldo mayor a sueldoTope
    public function debePagarImpuestos(): bool
    {
        return $this->edad > 21 && $this->sueldo > self::$sueldoTope;
    }

    // Método estático para obtener el sueldo tope
    public static function getSueldoTope(): float
    {
        return self::$sueldoTope;
    }

    // Método estático para establecer un nuevo sueldo tope
    public static function setSueldoTope(float $nuevoTope): void
    {
        self::$sueldoTope = $nuevoTope;
    }

    // Método para añadir un teléfono al array
    public function anyadirTelefono(int $telefono): void
    {
        $this->telefonos[] = $telefono;
    }

    // Getter para teléfonos
    public function getTelefonos(): array
    {
        return $this->telefonos;
    }

    // Método para listar los teléfonos separados por comas
    public function listarTelefonos(): string
    {
        return implode(', ', $this->telefonos);
    }

    // Método para vaciar el array de teléfonos
    public function vaciarTelefonos(): void
    {
        $this->telefonos = [];
    }

    // Método estático para generar el HTML con los datos de un empleado
    public static function toHtml(Empleado $emp): string
    {
        $html = "<p><strong>Nombre:</strong> " . $emp->getNombreCompleto() . "<br>";
        $html .= "<strong>Edad:</strong> " . $emp->getEdad() . "<br>";
        $html .= "<strong>Sueldo:</strong> " . $emp->getSueldo() . "€</p>";

        // Crear la lista de teléfonos en HTML
        $html .= "<ol>";
        foreach ($emp->getTelefonos() as $telefono) {
            $html .= "<li>" . htmlspecialchars($telefono) . "</li>";
        }
        $html .= "</ol>";

        return $html;
    }
}

