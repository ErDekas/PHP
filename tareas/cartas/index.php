<?php
require_once 'autoloader.php';

use Controllers\BarajaController;

// Controlador principal
$controller = new BarajaController();
$controller->mostrarBaraja();
