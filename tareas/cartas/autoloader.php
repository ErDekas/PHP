<?php
spl_autoload_register(function ($class) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        die("La clase {$class} no pudo ser cargada.");
    }
});
?>
