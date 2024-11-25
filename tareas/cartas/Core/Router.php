<?php

class Router {
    public function run() {
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        $controllerFile = "controllers/" . ucfirst($controller) . "Controller.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerClass = ucfirst($controller) . "Controller";
            $controllerObj = new $controllerClass();

            if (method_exists($controllerObj, $action)) {
                $controllerObj->$action();
            } else {
                echo "Acción no encontrada.";
            }
        } else {
            echo "Controlador no encontrado.";
        }
    }
}
