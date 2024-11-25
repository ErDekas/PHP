<?php
require_once 'Core/Router.php';
session_start();
// Inicia el enrutador y procesa la solicitud
$router = new Router();
$router->run();
