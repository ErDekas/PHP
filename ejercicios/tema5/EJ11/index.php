<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $codEmple = $_POST['codEmple'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];
    $codigoPostal = $_POST['codigoPostal'];

    // Cargar el archivo XML
    $xml = simplexml_load_file('empleados.xml');

    // Crear un nuevo empleado
    $nuevoEmpleado = $xml->addChild('empleado');
    $nuevoEmpleado->addAttribute('codEmple', $codEmple);
    $nuevoEmpleado->addChild('nombre', $nombre);
    $nuevoEmpleado->addChild('apellidos', $apellidos);
    $nuevoEmpleado->addChild('edad', $edad);
    $nuevoEmpleado->addChild('telefono', $telefono);
    $nuevoEmpleado->addChild('codigoPostal', $codigoPostal);

    // Guardar el archivo XML
    $xml->asXML('empleados.xml');

    // Redirigir o mostrar un mensaje de éxito
    echo "Empleado añadido exitosamente.";
}
?>
