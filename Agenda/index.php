<?php
require_once 'config/config.php';
require_once 'Lib/BaseDatos.php';
require_once 'models/Contacto.php';
require_once 'controllers/ContactoController.php';

use Controllers\ContactoController;

if (isset($_GET['action'])) {
    $controller = new ContactoController();
    if ($_GET['action'] === 'mostrar') {
        $controller->mostrarTodos();
    }
} else {
    echo "Bienvenido a la Agenda";
}
