<?php
require_once __DIR__ . '/includes/config.php';

if (estaLogueado()) {
    redireccionar('index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($usuario === '' || $password === '') {
        $error = 'Debe ingresar usuario y contraseña.';
    } else {
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['nombre'];
            $_SESSION['usuario_rol'] = $user['rol'];

            redireccionar('index.php');
        } else {
            $error = 'Usuario o contraseña incorrectos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-body">

<section class="login-container">
    <form method="POST" class="login-card">
        <h1>Gestión Segura de Archivos</h1>
        <p>Acceso privado al sistema</p>

        <?php if ($error): ?>
            <div class="alert error">
                <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Ingresar</button>
    </form>
</section>

</body>
</html>