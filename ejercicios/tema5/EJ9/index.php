<?php
// Cargar el XML
$xml = simplexml_load_file("departamentos.xml");

// Mostrar los empleados
foreach ($xml->empleado as $empleado) {
    echo "Código: " . $empleado['codEmple'] . "<br>";
    echo "Nombre: " . $empleado->nombre . "<br>";
    echo "Apellidos: " . $empleado->apellidos . "<br>";
    echo "Edad: " . $empleado->edad . "<br>";
    echo "<br>";
}

// Usar XPath para seleccionar empleados mayores de 25 años
$empleados_mayores = $xml->xpath("//empleado[edad>25]");
echo "Empleados mayores de 25 años:<br>";
foreach ($empleados_mayores as $empleado) {
    echo $empleado->nombre . "<br>";
}

// Validar el XML contra el esquema XSD
$dom = dom_import_simplexml($xml)->ownerDocument; // Convertir a DOMDocument
$esquema = "departamento.xsd";
if ($dom->schemaValidate($esquema)) {
    echo "El XML es válido según el esquema XSD.";
} else {
    echo "El XML no es válido.";
}
?>
