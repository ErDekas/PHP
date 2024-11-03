<?php
class EmpleadoConstante
{
    private const SUELDO_TOPE = 3333; // Constante para el límite de impuestos

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

    // Método para comprobar si debe pagar impuestos usando la constante SUELDO_TOPE
    public function debePagarImpuestos(): bool
    {
        return $this->sueldo > self::SUELDO_TOPE;
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
