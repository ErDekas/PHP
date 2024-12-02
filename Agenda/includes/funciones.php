<?php
// includes/funciones.php
session_start();

function verificarLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit();
    }
}

function esAdmin() {
    return isset($_SESSION['rol']) && 
           ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'super_admin');
}

function esSuperAdmin() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] == 'super_admin';
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function validarPassword($password, $hash) {
    return password_verify($password, $hash);
}

function mostrarMensaje($mensaje, $tipo = 'info') {
    $_SESSION['mensaje'] = [
        'texto' => $mensaje,
        'tipo' => $tipo
    ];
}

function imprimirMensaje() {
    if (isset($_SESSION['mensaje'])) {
        $clase = match($_SESSION['mensaje']['tipo']) {
            'error' => 'alert-danger',
            'exito' => 'alert-success',
            'advertencia' => 'alert-warning',
            default => 'alert-info'
        };
        
        echo "<div class='alert {$clase}'>" . 
             htmlspecialchars($_SESSION['mensaje']['texto']) . 
             "</div>";
        
        unset($_SESSION['mensaje']);
    }
}