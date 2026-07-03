<?php

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/classes/GestorArchivos.php';

$gestor = new GestorArchivos($conexion);

try {

    if (!isset($_GET['id'])) {
        throw new Exception("Archivo no encontrado.");
    }

    $archivo = $gestor->obtenerPorId((int)$_GET['id']);

    $ruta = UPLOAD_DIR . $archivo['nombre_guardado'];

    if (!file_exists($ruta)) {
        throw new Exception("El archivo físico no existe.");
    }

    header('Content-Description: File Transfer');
    header('Content-Type: '.$archivo['tipo']);
    header('Content-Disposition: attachment; filename="'.$archivo['nombre_original'].'"');
    header('Content-Length: '.filesize($ruta));

    readfile($ruta);
    exit;

} catch(Exception $e){

    $_SESSION['error']=$e->getMessage();

    redireccionar('index.php');

}