<?php
// admin/crear_usuario.php
require_once '../config/database.php';
require_once '../includes/funciones.php';

verificarLogin();

// Solo administradores pueden acceder
if (!esAdmin()) {
    mostrarMensaje('No tiene permisos para acceder', 'error');
    header('Location: ../dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $conn = $database->getConnection();

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $rol = $_POST['rol'];

    // Solo super admin puede crear administradores
    if ($rol == 'admin' && !esSuperAdmin()) {
        mostrarMensaje('No tiene permisos para crear administradores', 'error');
        header('Location: crear_usuario.php');
        exit();
    }

    try {
        $stmt = $conn->prepare("INSERT INTO usuarios 
            (username, email, password, nombre, apellidos, rol) 
            VALUES (:username, :email, :password, :nombre, :apellidos, :rol)");
        
        $password_hash = hashPassword($password);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':rol', $rol);

        if ($stmt->execute()) {
            mostrarMensaje('Usuario creado exitosamente', 'exito');
            header('Location: usuarios.php');
            exit();
        }
    } catch(PDOException $e) {
        mostrarMensaje('Error al crear usuario: ' . $e->getMessage(), 'error');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="container">
        <h1>Crear Nuevo Usuario</h1>
        <?php imprimirMensaje(); ?>
        
        <form method="POST">
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            
            <select name="rol">
                <?php if (esSuperAdmin()): ?>
                    <option value="admin">Administrador</option>
                <?php endif; ?>
                <option value="usuario" selected>Usuario</option>
            </select>
            
            <button type="submit">Crear Usuario</button>
            <a href="usuarios.php" class="btn btn-cancelar">Cancelar</a>
        </form>
    </div>
</body>
</html>