<?php
// a) Crear un array con al menos los datos de 3 profesores
$profesores = [
    [
        'registro' => 'P001',
        'nombre' => 'Juan',
        'apellido' => 'Pérez',
        'telefono' => '123456789',
        'fecha_nacimiento' => '1985-03-25',
    ],
    [
        'registro' => 'P002',
        'nombre' => 'Ana',
        'apellido' => 'Gómez',
        'telefono' => '987654321',
        'fecha_nacimiento' => '1992-07-15',
    ],
    [
        'registro' => 'P003',
        'nombre' => 'Luis',
        'apellido' => 'Martínez',
        'telefono' => '456789123',
        'fecha_nacimiento' => '1988-11-30',
    ],
];

// b) Función para mostrar el número de registro personal
function mostrarRegistros($profesores) {
    foreach ($profesores as $profesor) {
        echo "Registro: " . $profesor['registro'] . "<br>";
    }
}
mostrarRegistros($profesores);

// c) Función anónima con `array_map()`
$mostrarRegistrosAnonimo = function($profesor) {
    return $profesor['registro'];
};

$registros = array_map($mostrarRegistrosAnonimo, $profesores);
echo "Registros usando función anónima: " . implode(", ", $registros) . "<br>";

// d) Mostrar profesores nacidos a partir de 1990
$profesoresNacidosDesde1990 = array_filter($profesores, function($profesor) {
    return strtotime($profesor['fecha_nacimiento']) >= strtotime('1990-01-01');
});

echo "Profesores nacidos a partir de 1990:<br>";
foreach ($profesoresNacidosDesde1990 as $profesor) {
    echo $profesor['nombre'] . " " . $profesor['apellido'] . "<br>";
}
?>
