<?php
require_once __DIR__ . '/includes/config.php';

$nuevoHash = password_hash('Admin2026*', PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET password = :password WHERE usuario = 'admin'";
$stmt = $conexion->prepare($sql);
$stmt->execute([
    'password' => $nuevoHash
]);

echo "Contraseña actualizada correctamente.";