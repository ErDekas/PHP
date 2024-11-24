<?php

require('Model/Conexion.php');
$con = new Conexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Añadir un nuevo registro
    if (isset($_POST['añadir'])) {
        $concepto = $_POST['concepto'] ?? '';
        $fecha = $_POST['fecha'] ?? '';
        $importe = $_POST['importe'] ?? 0;

        if ($con->añadirRegistro($concepto, $fecha, $importe)) {
            echo "Registro añadido con éxito.";
        } else {
            echo "Error al añadir el registro.";
        }
        header('Location: index.php');
        exit;
    }

    // Editar un registro existente
    if (isset($_POST['editar'])) {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $concepto = $_POST['concepto'] ?? '';
        $fecha = $_POST['fecha'] ?? '';
        $importe = $_POST['importe'] ?? 0;

        if ($id && $con->editarRegistro($id, $concepto, $fecha, $importe)) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar el registro.";
        }
        header('Location: index.php');
        exit;
    }

    // Borrar un registro
    if (isset($_POST['borrar'])) {
        $id = $_POST['borrar'] ?? null;
        if ($id && $con->borrarRegistro($id)) {
            echo "Registro eliminado.";
        } else {
            echo "Error al eliminar el registro.";
        }
        header('Location: index.php');
        exit;
    }
}

// Obtener datos para editar un registro específico
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['editar'])) {
    $id = isset($_GET['editar']) ? (int)$_GET['editar'] : null;
    if ($id) {
        $registros = $con->getRegistros();
        $registro = array_filter($registros, fn($reg) => (int)$reg['ID'] === $id);
        $registro = !empty($registro) ? array_shift($registro) : null;
    } else {
        $registro = null;
    }
} else {
    $registro = null;
}

// Obtener todos los registros para mostrar en la tabla
$registros = $con->getRegistros();

require('View/V_verRegistros.php');
