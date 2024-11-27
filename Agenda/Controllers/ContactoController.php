<?php
namespace Controllers;

use Models\Contacto;

class ContactoController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Contacto();
    }

    public function mostrarTodos() {
        $contactos = $this->modelo->getAll();
        require_once 'views/contacto/mostrar_todos.php';
    }

    public function crear($nombre, $telefono, $email, $direccion) {
        $id = $this->modelo->create($nombre, $telefono, $email, $direccion);
        echo "Contacto creado con ID: " . $id;
    }
}
