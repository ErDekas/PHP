<?php

namespace Models;

use Lib\DataBase;
use PDO;
use PDOException;

class Contacto
{
    private DataBase $conexion;
    private mixed $stmt;

    // Constructor modificado para trabajar con PDO::FETCH_CLASS
    function __construct(
        private string|null $id = null,
        private string $nombre = "",  // Cambiar
        private string $apellido = "", // Cambiar
        private string $telefono = "", // Cambiar
        private string $correo = "",
        private string $direccion = "",
        private ?string $fecha_nacimiento = "",
    ) {
        $this->conexion = new DataBase(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    }

    // Getter y Setter para 'id'
    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    // Getter y Setter para 'nombre'
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    // Getter y Setter para 'apellido'
    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): void
    {
        $this->apellido = $apellido;
    }

    // Getter y Setter para 'telefono'
    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    // Getter y Setter para 'correo'
    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): void
    {
        $this->correo = $correo;
    }

    // Getter y Setter para 'direccion'
    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): void
    {
        $this->direccion = $direccion;
    }

    // Getter y Setter para 'fecha_nacimiento'
    public function getFechaNacimiento(): ?string
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(?string $fecha_nacimiento): void
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    /**
     * Obtiene todos los registros de la tabla 'contactos' y los convierte en objetos Contacto.
     * 
     * @return array Lista de objetos Contacto.
     */
    public function getAll(): array
    {
        try {
            $sql = "SELECT * FROM contactos"; // Asegúrate de que la tabla y columnas existan

            // Preparar la consulta
            $stmt = $this->conexion->getConnection()->prepare($sql);
            $stmt->execute();

            // Verifica el contenido de la consulta
            $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Models\\Contacto");

            var_dump($result); // Verifica si se están obteniendo resultados

            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return []; // Retorna un array vacío en caso de error
        }
    }

    public function insertar(): bool
    {
        try {
            // Consulta SQL para insertar un nuevo contacto
            $sql = "INSERT INTO contactos (nombre, apellido, telefono, correo, direccion, fecha_nacimiento)
                    VALUES (:nombre, :apellido, :telefono, :correo, :direccion, :fecha_nacimiento)";

            // Preparar la consulta
            $stmt = $this->conexion->getConnection()->prepare($sql);

            // Vincular los parámetros a las propiedades del objeto
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellidos', $this->apellido);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':correo', $this->correo);
            $stmt->bindParam(':direccion', $this->direccion);
            $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento);

            // Ejecutar la consulta
            $stmt->execute();

            // Retorna true si la inserción fue exitosa
            return true;

        } catch (PDOException $e) {
            echo "Error al insertar: " . $e->getMessage();
            return false;
        }
    }
}
