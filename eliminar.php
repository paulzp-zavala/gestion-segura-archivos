<?php

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/classes/GestorArchivos.php';

$gestor = new GestorArchivos($conexion);

try {

    if (!isset($_GET['id'])) {
        throw new Exception('No se recibió el ID del archivo.');
    }

    $id = (int) $_GET['id'];

    $mensaje = $gestor->eliminar($id);

    registrarLog(
        $conexion,
        "Archivo eliminado por " . $_SESSION['usuario_nombre']
    );

    $_SESSION['mensaje'] = $mensaje;

} catch (Exception $e) {

    $_SESSION['error'] = $e->getMessage();

}

redireccionar('index.php');