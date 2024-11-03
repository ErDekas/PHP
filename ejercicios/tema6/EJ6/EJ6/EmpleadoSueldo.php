<?php
class EmpleadoSueldo
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
}

// Ejemplo de uso
$empleado = new EmpleadoSueldo("Juan", "Pérez");
echo $empleado->getNombreCompleto(); // Imprime "Juan Pérez"
echo $empleado->getSueldo(); // Imprime "1000" por defecto

$empleado2 = new EmpleadoSueldo("Ana", "García", 3500);
echo $empleado2->debePagarImpuestos() ? "Debe pagar impuestos" : "No debe pagar impuestos";

