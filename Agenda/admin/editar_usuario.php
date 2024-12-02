<?php
// admin/editar_usuario.php
require_once '../config/database.php';
require_once '../includes/funciones.php';

verificarLogin();

// Solo administradores pueden acceder
if (!esAdmin()) {
    mostrarMensaje('No tiene permisos para acceder', 'error');
    header('Location: ../dashboard.php');
    exit();
}

$database = new Database();
$conn = $database->getConnection();

// Obtener ID de usuario a editar
$id = $_GET['id'] ?? null;

if (!$id) {
    mostrarMensaje('ID de usuario no proporcionado', 'error');
    header('Location: usuarios.php');
    exit();
}

// Obtener datos del usuario
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    mostrarMensaje('Usuario no encontrado', 'error');
    header('Location: usuarios.php');
    exit();
}

// Procesar formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $rol = $_POST['rol'];
    $activo = isset($_POST['activo']) ? 1 : 0;

    // Control de permisos para cambiar rol
    if ($rol != $usuario['rol'] && !esSuperAdmin()) {
        mostrarMensaje('No tiene permisos para cambiar el rol', 'error');
        header('Location: editar_usuario.php?id=' . $id);
        exit();
    }

    try {
        // Preparar consulta de actualización
        $campos = [
            'username = :username', 
            'email = :email', 
            'nombre = :nombre', 
            'apellidos = :apellidos',
            'activo = :activo'
        ];

        // Añadir rol solo si es super admin
        if (esSuperAdmin()) {
            $campos[] = 'rol = :rol';
        }

        // Si se proporciona nueva contraseña
        if (!empty($_POST['password'])) {
            $campos[] = 'password = :password';
        }

        $sql = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':activo', $activo);

        // Añadir rol si es super admin
        if (esSuperAdmin()) {
            $stmt->bindParam(':rol', $rol);
        }

        // Actualizar contraseña si se proporciona
        if (!empty($_POST['password'])) {
            $password_hash = hashPassword($_POST['password']);
            $stmt->bindParam(':password', $password_hash);
        }

        if ($stmt->execute()) {
            mostrarMensaje('Usuario actualizado exitosamente', 'exito');
            header('Location: usuarios.php');
            exit();
        }
    } catch(PDOException $e) {
        mostrarMensaje('Error al actualizar usuario: ' . $e->getMessage(), 'error');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <?php imprimirMensaje(); ?>
        
        <form method="POST">
            <input type="text" name="username" 
                   value="<?= htmlspecialchars($usuario['username']) ?>" 
                   placeholder="Nombre de usuario" required>
            
            <input type="email" name="email" 
                   value="<?= htmlspecialchars($usuario['email']) ?>" 
                   placeholder="Correo electrónico" required>
            
            <input type="password" name="password" 
                   placeholder="Nueva contraseña (opcional)">
            
            <input type="text" name="nombre" 
                   value="<?= htmlspecialchars($usuario['nombre']) ?>" 
                   placeholder="Nombre" required>
            
            <input type="text" name="apellidos" 
                   value="<?= htmlspecialchars($usuario['apellidos']) ?>" 
                   placeholder="Apellidos" required>
            
            <?php if (esSuperAdmin()): ?>
            <select name="rol">
                <option value="admin" 
                    <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>
                    Administrador
                </option>
                <option value="usuario" 
                    <?= $usuario['rol'] == 'usuario' ? 'selected' : '' ?>>
                    Usuario
                </option>
            </select>
            <?php endif; ?>

            <div class="checkbox-container">
                <label>
                    <input type="checkbox" name="activo" 
                           <?= $usuario['activo'] ? 'checked' : '' ?>>
                    Cuenta activa
                </label>
            </div>
            
            <button type="submit">Actualizar Usuario</button>
            <a href="usuarios.php" class="btn btn-cancelar">Cancelar</a>
        </form>
    </div>
</body>
</html>