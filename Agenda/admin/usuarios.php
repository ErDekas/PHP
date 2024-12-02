<?php
// admin/usuarios.php
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

// Eliminar usuario
if (isset($_GET['eliminar'])) {
    if (!esSuperAdmin()) {
        mostrarMensaje('No tiene permisos para eliminar', 'error');
        header('Location: usuarios.php');
        exit();
    }

    $id = $_GET['eliminar'];
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = :id AND rol != 'super_admin'");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    mostrarMensaje('Usuario eliminado exitosamente', 'exito');
}

// Listar usuarios, incluyendo al super admin si el usuario actual es super admin
$query = "SELECT id, username, email, nombre, apellidos, rol, activo FROM usuarios";
if (!esSuperAdmin()) {
    $query .= " WHERE rol != 'super_admin'";
}

$stmt = $conn->prepare($query);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de Usuarios</h1>
        <?php imprimirMensaje(); ?>
        
        <a href="crear_usuario.php" class="btn btn-primary">Crear Nuevo Usuario</a>
        
        <table>
            <thead>
                <tr>
                    <th>Nombre de Usuario</th>
                    <th>Email</th>
                    <th>Nombre Completo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['username']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellidos']) ?></td>
                    <td><?= htmlspecialchars($usuario['rol']) ?></td>
                    <td><?= $usuario['activo'] ? 'Activo' : 'Inactivo' ?></td>
                    <td>
                        <a href="editar_usuario.php?id=<?= $usuario['id'] ?>" class="btn btn-editar">Editar</a>
                        <?php if (esSuperAdmin() && $usuario['rol'] != 'super_admin'): ?>
                        <a href="usuarios.php?eliminar=<?= $usuario['id'] ?>" 
                           class="btn btn-eliminar" 
                           onclick="return confirm('¿Está seguro de eliminar este usuario?')">
                            Eliminar
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>