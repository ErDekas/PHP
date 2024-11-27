<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Contactos</title>
</head>
<body>
    <h1>Contactos</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Dirección</th>
        </tr>
        <?php foreach ($contactos as $contacto): ?>
            <tr>
                <td><?= $contacto['id'] ?></td>
                <td><?= $contacto['nombre'] ?></td>
                <td><?= $contacto['telefono'] ?></td>
                <td><?= $contacto['email'] ?></td>
                <td><?= $contacto['direccion'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
