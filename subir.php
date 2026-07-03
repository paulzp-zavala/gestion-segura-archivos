<?php

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/classes/GestorArchivos.php';

$gestor = new GestorArchivos($conexion);

try {

    if (!isset($_FILES['archivo'])) {
        throw new Exception('No se recibió ningún archivo.');
    }

    $mensaje = $gestor->subir($_FILES['archivo']);

    registrarLog(
        $conexion,
        "Archivo subido por " . $_SESSION['usuario_nombre']
    );

    $_SESSION['mensaje'] = $mensaje;

} catch (Exception $e) {

    $_SESSION['error'] = $e->getMessage();

}

redireccionar('index.php');