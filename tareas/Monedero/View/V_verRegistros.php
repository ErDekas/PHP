<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monedero</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <h1>Gestión del Monedero</h1>

    <!-- Formulario para añadir o editar registros -->
    <?php if ($registro): ?>
        <h2>Editar Registro</h2>
        <form method="POST" action="index.php" class="campos">
            <input type="hidden" name="id" value="<?= htmlspecialchars($registro['ID']) ?>">
            <label for="concepto">Concepto:</label>
            <input type="text" id="concepto" name="concepto" value="<?= htmlspecialchars($registro['Concepto']) ?>" required>
            <br><br>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?= htmlspecialchars($registro['Fecha']) ?>" required>
            <br><br>
            <label for="importe">Importe:</label>
            <input type="number" step="0.01" id="importe" name="importe" value="<?= htmlspecialchars($registro['Importe']) ?>" required>
            <br><br>
            <button type="submit" name="editar" class="confirmacion">Guardar Cambios</button>
            <div class="botones"><a href="index.php" class="cancelacion">Cancelar</a></div>
        </form>
    <?php else: ?>
        <h2>Añadir Registro</h2>
        <form method="POST" action="index.php" class="campos">
            <label for="concepto">Concepto:</label>
            <input type="text" id="concepto" name="concepto" placeholder="Concepto" required>
            <br><br>
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>
            <br><br>
            <label for="importe">Importe:</label>
            <input type="number" step="0.01" id="importe" name="importe" placeholder="Importe" required>
            <br><br>
            <button type="submit" name="añadir" class="confirmacion">Añadir</button>
        </form>
    <?php endif; ?>

    <!-- Tabla de registros -->
    <h2>Lista de Registros</h2>
    <table>
        <thead>
            <tr>
                <th>Concepto</th>
                <th>Fecha</th>
                <th>Importe</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($registros)): ?>
                <?php foreach ($registros as $reg): ?>
                    <tr>
                        <td><?= htmlspecialchars($reg['Concepto']) ?></td>
                        <td><?= htmlspecialchars($reg['Fecha']) ?></td>
                        <td><?= htmlspecialchars($reg['Importe']) ?></td>
                        <td class="acciones">
                            <!-- Botón para editar -->
                            <form method="GET" action="index.php" class="botones">
                                <input type="hidden" name="editar" value="<?= htmlspecialchars($reg['ID']) ?>">
                                <button type="submit">Editar</button>
                            </form>
                            <!-- Botón para borrar -->
                            <form method="POST" action="index.php" onsubmit="return confirm('¿Seguro que deseas borrar este registro?');" class="botones">
                                <input type="hidden" name="borrar" value="<?= htmlspecialchars($reg['ID']) ?>">
                                <button type="submit">Borrar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay registros disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>