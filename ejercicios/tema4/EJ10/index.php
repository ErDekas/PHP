<?php
// Inicialización de variables
$nombre = $apellidos = $email = $telefono = $empleo = $url = "";
$lenguajes = [];
$mensaje = "";
$errores = [];

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar y limpiar los datos
    $nombre = stripslashes(trim($_POST['nombre']));
    $apellidos = stripslashes(trim($_POST['apellidos']));
    $email = stripslashes(trim($_POST['email']));
    $telefono = stripslashes(trim($_POST['telefono']));
    $empleo = isset($_POST['empleo']) ? $_POST['empleo'] : '';
    $lenguajes = isset($_POST['lenguajes']) ? $_POST['lenguajes'] : [];
    $url = stripslashes(trim($_POST['url']));

    // Validaciones
    if (empty($nombre) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombre)) {
        $errores[] = "El nombre es inválido. Solo se permiten letras.";
    }

    if (empty($apellidos) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $apellidos)) {
        $errores[] = "Los apellidos son inválidos. Solo se permiten letras.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    if (empty($telefono) || !preg_match("/^\d{9}$/", $telefono)) {
        $errores[] = "El teléfono debe tener exactamente 9 dígitos.";
    }

    if (empty($empleo)) {
        $errores[] = "Debes seleccionar tu empleo actual.";
    }

    if (!empty($url) && !filter_var($url, FILTER_VALIDATE_URL)) {
        $errores[] = "La URL no es válida.";
    }

    // Si no hay errores, mostrar los datos
    if (empty($errores)) {
        $mensaje = "Nombre: $nombre<br>Apellidos: $apellidos<br>Email: $email<br>Teléfono: $telefono<br>Empleo Actual: $empleo<br>Lenguajes: " . implode(", ", $lenguajes) . "<br>URL: $url";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Empleado</title>
</head>
<body>
    <h1>Formulario de Futuro Empleado</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nombre">Nombre: 
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
        </label><br>

        <label for="apellidos">Apellidos: 
            <input type="text" id="apellidos" name="apellidos" value="<?php echo htmlspecialchars($apellidos); ?>" required>
        </label><br>

        <label for="email">Email: 
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </label><br>

        <label for="telefono">Teléfono: 
            <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>" required>
        </label><br>

        <fieldset>
            <legend>Empleo Actual:</legend>
            <label><input type="radio" name="empleo" value="sin empleo" <?php if ($empleo == "sin empleo") echo "checked"; ?>> Sin Empleo</label><br>
            <label><input type="radio" name="empleo" value="media jornada" <?php if ($empleo == "media jornada") echo "checked"; ?>> Media Jornada</label><br>
            <label><input type="radio" name="empleo" value="tiempo completo" <?php if ($empleo == "tiempo completo") echo "checked"; ?>> Tiempo Completo</label>
        </fieldset>

        <fieldset>
            <legend>Lenguajes que dominas:</legend>
            <label><input type="checkbox" name="lenguajes[]" value="Python" <?php if (in_array("Python", $lenguajes)) echo "checked"; ?>> Python</label><br>
            <label><input type="checkbox" name="lenguajes[]" value="PHP" <?php if (in_array("PHP", $lenguajes)) echo "checked"; ?>> PHP</label><br>
            <label><input type="checkbox" name="lenguajes[]" value="JavaScript" <?php if (in_array("JavaScript", $lenguajes)) echo "checked"; ?>> JavaScript</label><br>
            <label><input type="checkbox" name="lenguajes[]" value="Java" <?php if (in_array("Java", $lenguajes)) echo "checked"; ?>> Java</label><br>
            <label><input type="checkbox" name="lenguajes[]" value="C++" <?php if (in_array("C++", $lenguajes)) echo "checked"; ?>> C++</label>
        </fieldset>

        <label for="url">URL de trabajos realizados: 
            <input type="text" id="url" name="url" value="<?php echo htmlspecialchars($url); ?>">
        </label><br>

        <input type="submit" value="Enviar">
    </form>

    <?php if (!empty($errores)): ?>
        <h2>Errores:</h2>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($mensaje): ?>
        <h2>Datos Validados:</h2>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>
</body>
</html>
