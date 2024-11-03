<?php
// Ejemplo de uso Empleados.php
$empleado = new Empleado("Juan", "Pérez", 4000);
echo $empleado->getNombreCompleto(); // Imprime "Juan Pérez"
echo $empleado->debePagarImpuestos() ? "Debe pagar impuestos" : "No debe pagar impuestos";

// Ejemplo de uso EmpleadoTelefonos.php
$empleado = new EmpleadoTelefonos("Juan", "Pérez", 4000);
$empleado->anyadirTelefono(123456789);
$empleado->anyadirTelefono(987654321);
echo $empleado->getNombreCompleto(); // Imprime "Juan Pérez"
echo $empleado->debePagarImpuestos() ? "Debe pagar impuestos" : "No debe pagar impuestos";
echo $empleado->listarTelefonos(); // Imprime "123456789, 987654321"
$empleado->vaciarTelefonos();
echo $empleado->listarTelefonos(); // Imprime ""


// Ejemplo de uso
$empleado = new EmpleadoConstructor("Juan", "Pérez");
echo $empleado->getNombreCompleto(); // Imprime "Juan Pérez"
echo $empleado->getSueldo(); // Imprime "1000" por defecto
$empleado2 = new EmpleadoConstructor("Ana", "García", 3500);
echo $empleado2->getSueldo(); // Imprime "3500"
echo $empleado2->debePagarImpuestos() ? "Debe pagar impuestos" : "No debe pagar impuestos";


// Ejemplo de uso
$empleado = new EmpleadoConstructor8("Juan", "Pérez");
echo $empleado->getNombreCompleto(); // Imprime "Juan Pérez"
echo $empleado->getSueldo(); // Imprime "1000" por defecto
$empleado2 = new EmpleadoConstructor8("Ana", "García", 3500);
echo $empleado2->getSueldo(); // Imprime "3500"
echo $empleado2->debePagarImpuestos() ? "Debe pagar impuestos" : "No debe pagar impuestos";


// Ejemplo de uso
$empleado = new EmpleadoConstante("Juan", "Pérez");
echo $empleado->getNombreCompleto(); // Imprime "Juan Pérez"
echo $empleado->getSueldo(); // Imprime "1000" por defecto
$empleado2 = new EmpleadoConstante("Ana", "García", 3500);
echo $empleado2->debePagarImpuestos() ? "Debe pagar impuestos" : "No debe pagar impuestos";


// Modificar el sueldo tope
EmpleadoSueldo::setSueldoTope(4000);
echo EmpleadoSueldo::getSueldoTope(); // Imprime "4000"
echo $empleado2->debePagarImpuestos() ? "Debe pagar impuestos" : "No debe pagar impuestos"; // Ahora devolverá false


// Ejemplo de uso
$empleado = new EmpleadoStatic("Juan", "Pérez", 4000);
$empleado->anyadirTelefono(123456789);
$empleado->anyadirTelefono(987654321);

// Generar el HTML y mostrarlo
echo EmpleadoStatic::toHtml($empleado);


// Ejemplo de uso
$empleado = new Empleado("Juan", "Pérez", 4000);
$empleado->anyadirTelefono(123456789);
$empleado->anyadirTelefono(987654321);

// Generar el HTML y mostrarlo
echo Empleado::toHtml($empleado);


// Ejemplo de uso
$empleado = new Empleado("Juan", "Pérez", 25, 4000);
$empleado->anyadirTelefono(123456789);
$empleado->anyadirTelefono(987654321);

// Generar el HTML y mostrarlo
echo Empleado::toHtml($empleado);

// Verificar si debe pagar impuestos
echo $empleado->debePagarImpuestos() ? "Debe pagar impuestos" : "No debe pagar impuestos";

?>