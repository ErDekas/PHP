<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Agenda</h1>

    <?php
    require_once 'Config/config.php';
    require_once 'autoloader.php';
    require_once 'Lib/DataBase.php';

    use Models\Contacto;

    $contacto = new Contacto(
        null,              // ID no se pasa porque es autoincremental en la base de datos
        "Juan",            // Nombre
        "Pérez",           // Apellido
        "987654321",       // Teléfono
        "juan@correo.com", // Correo
        "Calle Falsa 456", // Dirección
        "1990-05-15"       // Fecha de nacimiento
    );

    echo "<p>ID: " . $contacto->getId() . "</p>";
    echo "<p>Nombre: " . $contacto->getNombre() . "</p>";
    echo "<p>Apellido: " . $contacto->getApellido() . "</p>";
    echo "<p>Telefono: " . $contacto->getTelefono() . "</p>";
    echo "<p>Correo: " . $contacto->getCorreo() . "</p>";
    echo "<p>Direccion: " . $contacto->getDireccion() . "</p>";
    echo "<p>Fecha Nacimiento: " . $contacto->getFechaNacimiento() . "</p>";

    echo "<p>Nombre: " . $contacto->getNombre() . "</p>";
    // Insertar el nuevo contacto en la base de datos
    if ($contacto->insertar()) {
        echo "Contacto insertado correctamente.";
    } else {
        echo "Hubo un error al insertar el contacto.";
    }
    try {
        // Crear conexión usando PDO
        $conexion = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DBNAME, USERNAME, PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<h2>Conexión realizada correctamente</h2>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Crear una instancia de Contacto para obtener todos los registros
    $contactoModel = new Contacto();  // Renombramos para evitar la sobreescritura
    $contactos = $contactoModel->getAll();

    // Mostrar la información de los contactos en la tabla
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Telefono</th><th>Correo</th><th>Direccion</th><th>Fecha Nacimiento</th></tr>";

    foreach ($contactos as $contactoItem) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($contactoItem->getId()) . "</td>";
        echo "<td>" . htmlspecialchars($contactoItem->getNombre()) . "</td>";
        echo "<td>" . htmlspecialchars($contactoItem->getApellido()) . "</td>";
        echo "<td>" . htmlspecialchars($contactoItem->getTelefono()) . "</td>";
        echo "<td>" . htmlspecialchars($contactoItem->getCorreo()) . "</td>";
        echo "<td>" . htmlspecialchars($contactoItem->getDireccion()) . "</td>";
        echo "<td>" . htmlspecialchars($contactoItem->getFechaNacimiento()) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    ?>
</body>

</html>