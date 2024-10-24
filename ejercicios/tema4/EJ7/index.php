<?php
// Funciones para gestionar el array de alumnos
function crearAlumnos() {
    return [
        "Marta" => 7.8,
        "Luis" => 5,
        "Lorena" => 6.9,
        "Javier" => 8.2,
    ];
}

function añadirAlumno(&$alumnos, $nombre, $nota) {
    if (array_key_exists($nombre, $alumnos)) {
        // Si el alumno ya existe, se sobrescribe la nota
        $alumnos[$nombre] = $nota;
    } else {
        $alumnos[$nombre] = $nota;
    }
}

function mostrarAlumnos($alumnos) {
    echo "<table border='1'>
            <tr>
                <th>Alumno</th>
                <th>Nota</th>
            </tr>";
    foreach ($alumnos as $nombre => $nota) {
        echo "<tr>
                <td>$nombre</td>
                <td>$nota</td>
              </tr>";
    }
    echo "</table>";
}

function calcularMedia($alumnos) {
    $suma = array_sum($alumnos);
    return $suma / count($alumnos);
}

// Inicialización
$alumnos = crearAlumnos();
$mensaje = "";

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $nota = floatval($_POST['nota']);

    if (!empty($nombre) && $nota >= 0) {
        añadirAlumno($alumnos, $nombre, $nota);
        $mensaje = "Alumno añadido: $nombre con nota $nota";
    } else {
        $mensaje = "Por favor, introduce un nombre y una nota válida.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos</title>
</head>
<body>
    <h1>Gestión de Alumnos</h1>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nombre">Nombre: 
            <input type="text" id="nombre" name="nombre" required>
        </label><br>

        <label for="nota">Nota: 
            <input type="number" id="nota" name="nota" step="0.1" required>
        </label><br>

        <input type="submit" value="Añadir Alumno">
    </form>

    <?php if ($mensaje): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <h2>Notas de los Alumnos</h2>
    <?php mostrarAlumnos($alumnos); ?>

    <h2>Media de Notas: <?php echo number_format(calcularMedia($alumnos), 2); ?></h2>
</body>
</html>
