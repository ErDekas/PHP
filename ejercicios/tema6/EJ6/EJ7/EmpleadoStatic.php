<?php
class EmpleadoStatic
{
    private static float $sueldoTope = 3333; // Variable estática para el límite de impuestos

    // Constructor con promoción de propiedades de PHP 8
    public function __construct(
        private string $nombre,
        private string $apellidos,
        private float $sueldo = 1000,
        private array $telefonos = [] // Array para almacenar los números de teléfono
    ) {}

    // Getter para nombre
    public function getNombre(): string
    {
        return $this->nombre;
    }

    // Getter para apellidos
    public function getApellidos(): string
    {
        return $this->apellidos;
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

    // Getter para teléfonos
    public function getTelefonos(): array
    {
        return $this->telefonos;
    }

    // Método para obtener el nombre completo
    public function getNombreCompleto(): string
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

    // Método para comprobar si debe pagar impuestos usando la variable estática sueldoTope
    public function debePagarImpuestos(): bool
    {
        return $this->sueldo > self::$sueldoTope;
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
    public static function toHtml(EmpleadoStatic $emp): string
    {
        $html = "<p><strong>Nombre:</strong> " . $emp->getNombreCompleto() . "<br>";
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

