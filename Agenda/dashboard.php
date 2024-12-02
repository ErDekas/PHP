<?php
// dashboard.php
require_once 'config/database.php';
require_once 'includes/funciones.php';

verificarLogin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?></h1>
        
        <?php if (esAdmin()): ?>
            <div class="admin-links">
                <a href="admin/usuarios.php" class="btn btn-primary">Gestionar Usuarios</a>
            </div>
        <?php endif; ?>

        <a href="logout.php" class="btn btn-logout">Cerrar Sesión</a>
    </div>
</body>
</html>